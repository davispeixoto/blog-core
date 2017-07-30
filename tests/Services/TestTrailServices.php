<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 7/23/17
 * Time: 2:12 PM
 */

namespace DavisPeixoto\BlogCore\Tests\Services;

use DateTime;
use DavisPeixoto\BlogCore\Entity\Author;
use DavisPeixoto\BlogCore\Entity\Post;
use DavisPeixoto\BlogCore\Entity\Trail;
use DavisPeixoto\BlogCore\Repository\AbstractTrailRepository;
use DavisPeixoto\BlogCore\Service\CreateTrail;
use DavisPeixoto\BlogCore\Service\DeleteTrail;
use DavisPeixoto\BlogCore\Service\EditTrail;
use DavisPeixoto\BlogCore\Service\GetTrail;
use DavisPeixoto\BlogCore\Service\ListTrails;
use Exception;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class TestTrailServices extends TestCase
{
    /**
     * @LoggerInterface
     */
    private $logger;

    /**
     * @RepositoryInterface
     */
    private $trailRepository;

    /**
     * @UuidInterface
     */
    private $uuid;

    /**
     * @UuidInterface
     */
    private $authorUuid;

    /**
     * @UuidInterface
     */
    private $postUuid;

    /**
     * @Trail
     */
    private $trail;

    /**
     * @Author
     */
    private $author;

    /**
     * @Post
     */
    private $post;

    /**
     * @array
     */
    private $filters;

    public function setUp()
    {
        $this->logger = $this->createMock(LoggerInterface::class);
        $this->trailRepository = $this->getMockForAbstractClass(AbstractTrailRepository::class);
        $this->authorUuid = null;
        $this->author = new Author('Davis', 'email@example.org', 'Some string', $this->authorUuid, new DateTime());
        $this->postUuid = null;
        $this->uuid = Uuid::uuid4()->toString();
        $this->post = new Post('A Post', 'Lorem ipsum', $this->author, $this->postUuid, [], null);
        $this->trail = new Trail('A trail', 'An amazing trail', $this->uuid, [$this->post]);
        $this->filters = [];
    }

    public function testCreateTrailService()
    {
        $this->trailRepository->expects($this->once())->method('save')->will($this->returnValue($this->uuid));
        $service = new CreateTrail($this->trailRepository, $this->trail, $this->logger);
        $this->assertEquals($this->uuid, $service->run(), 'called once!');
    }

    public function testCreateTrailServiceShouldReturnNullOnFailure()
    {
        $this->logger->expects($this->once())->method('error');
        $this->trailRepository->expects($this->once())->method('save')->will($this->throwException(new Exception()));
        $service = new CreateTrail($this->trailRepository, $this->trail, $this->logger);
        $this->assertEquals(null, $service->run(), 'Test exception');
    }

    public function testEditTrailService()
    {
        $this->trailRepository->expects($this->once())->method('save')->will($this->returnValue($this->uuid));
        $service = new EditTrail($this->trailRepository, $this->trail, $this->logger);
        $this->assertEquals($this->uuid, $service->run(), 'called once!');
    }

    public function testEditTrailServiceShouldReturnNullOnFailure()
    {
        $this->logger->expects($this->once())->method('error');
        $this->trailRepository->expects($this->once())->method('save')->will($this->throwException(new Exception()));
        $service = new EditTrail($this->trailRepository, $this->trail, $this->logger);
        $this->assertEquals(null, $service->run(), 'Test exception');
    }

    public function testDeleteTrailService()
    {
        $this->trailRepository->expects($this->once())->method('delete')->will($this->returnValue(true));
        $service = new DeleteTrail($this->trailRepository, $this->trail, $this->logger);
        $this->assertEquals(true, $service->run(), 'Success');
    }

    public function testDeleteTrailServiceReturningFalse()
    {
        $this->trailRepository->expects($this->once())->method('delete')->will($this->returnValue(false));
        $service = new DeleteTrail($this->trailRepository, $this->trail, $this->logger);
        $this->assertEquals(false, $service->run(), 'Success');
    }

    public function testDeleteTrailServiceShouldReturnFalseOnFailure()
    {
        $this->logger->expects($this->once())->method('error');
        $this->trailRepository->expects($this->once())->method('delete')->will($this->throwException(new Exception()));
        $service = new DeleteTrail($this->trailRepository, $this->trail, $this->logger);
        $this->assertEquals(false, $service->run(), 'Test exception');
    }

    public function testGetTrailService()
    {
        $this->trailRepository->expects($this->once())->method('get')->will($this->returnValue($this->trail));
        $service = new GetTrail($this->trailRepository, $this->uuid, $this->logger);
        $this->assertEquals($this->trail, $service->run(), 'Success');
    }

    public function testGetTrailServiceReturningException()
    {
        $this->logger->expects($this->once())->method('error');
        $this->trailRepository->expects($this->once())->method('get')->will($this->throwException(new Exception()));
        $service = new GetTrail($this->trailRepository, $this->uuid, $this->logger);
        $this->assertEquals(false, $service->run(), 'Exception');
    }

    public function testGetTrailServiceReturningFalse()
    {
        $this->trailRepository->expects($this->once())->method('get')->will($this->returnValue(false));
        $service = new GetTrail($this->trailRepository, $this->uuid, $this->logger);
        $this->assertEquals(false, $service->run(), 'False');
    }

    public function testGetTrailsListService()
    {
        $this->trailRepository->expects($this->once())->method('getList')->with($this->filters)->will($this->returnValue([$this->trail]));
        $service = new ListTrails($this->trailRepository, $this->filters, $this->logger);
        $this->assertEquals([$this->trail], $service->run(), 'Success');
    }

    public function testGetTrailsListServiceException()
    {
        $this->logger->expects($this->once())->method('error');
        $this->trailRepository->expects($this->once())->method('getList')->with($this->filters)->will($this->throwException(new Exception()));
        $service = new ListTrails($this->trailRepository, $this->filters, $this->logger);
        $this->assertEquals([], $service->run(), 'Exception');
    }
}

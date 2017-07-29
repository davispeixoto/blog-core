<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 7/23/17
 * Time: 2:12 PM
 */

namespace DavisPeixoto\BlogCore\Tests\Services;

use PHPUnit\Framework\TestCase;
use DavisPeixoto\BlogCore\Entity\Author;
use DavisPeixoto\BlogCore\Service\CreateAuthor;
use DavisPeixoto\BlogCore\Service\EditAuthor;
use DavisPeixoto\BlogCore\Service\DeleteAuthor;
use DavisPeixoto\BlogCore\Service\GetAuthor;
use DavisPeixoto\BlogCore\Service\ListAuthors;
use DavisPeixoto\BlogCore\Repository\AbstractAuthorRepository;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Psr\Log\LoggerInterface;
use DateTime;
use Exception;

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
     * @Author
     */
    private $trail;

    /**
     * @array
     */
    private $filters;

    public function setUp()
    {
        $this->logger = $this->createMock(LoggerInterface::class);
        $this->trailRepository = $this->getMockForAbstractClass(AbstractAuthorRepository::class);
        $this->uuid = Uuid::uuid4();
        $this->trail = new Author($this->uuid, 'Davis', 'email@example.org', 'Some string', new DateTime());
        $this->filters = [];
    }

    public function testCreateAuthorService()
    {
        $this->trailRepository->expects($this->once())->method('save')->will($this->returnValue($this->uuid));
        $service = new CreateAuthor($this->trailRepository, $this->trail, $this->logger);
        $this->assertEquals($this->uuid, $service->run(), 'called once!');
    }

    public function testCreateAuthorServiceShouldReturnNullOnFailure()
    {
        $this->logger->expects($this->once())->method('error');
        $this->trailRepository->expects($this->once())->method('save')->will($this->throwException(new Exception()));
        $service = new CreateAuthor($this->trailRepository, $this->trail, $this->logger);
        $this->assertEquals(null, $service->run(), 'Test exception');
    }

    public function testEditAuthorService()
    {
        $this->trailRepository->expects($this->once())->method('save')->will($this->returnValue($this->uuid));
        $service = new EditAuthor($this->trailRepository, $this->trail, $this->logger);
        $this->assertEquals($this->uuid, $service->run(), 'called once!');
    }

    public function testEditAuthorServiceShouldReturnNullOnFailure()
    {
        $this->logger->expects($this->once())->method('error');
        $this->trailRepository->expects($this->once())->method('save')->will($this->throwException(new Exception()));
        $service = new EditAuthor($this->trailRepository, $this->trail, $this->logger);
        $this->assertEquals(null, $service->run(), 'Test exception');
    }

    public function testDeleteAuthorService()
    {
        $this->trailRepository->expects($this->once())->method('delete')->will($this->returnValue(true));
        $service = new DeleteAuthor($this->trailRepository, $this->trail, $this->logger);
        $this->assertEquals(true, $service->run(), 'Success');
    }

    public function testDeleteAuthorServiceReturningFalse()
    {
        $this->trailRepository->expects($this->once())->method('delete')->will($this->returnValue(false));
        $service = new DeleteAuthor($this->trailRepository, $this->trail, $this->logger);
        $this->assertEquals(false, $service->run(), 'Success');
    }

    public function testDeleteAuthorServiceShouldReturnFalseOnFailure()
    {
        $this->logger->expects($this->once())->method('error');
        $this->trailRepository->expects($this->once())->method('delete')->will($this->throwException(new Exception()));
        $service = new DeleteAuthor($this->trailRepository, $this->trail, $this->logger);
        $this->assertEquals(false, $service->run(), 'Test exception');
    }

    public function testGetAuthorService()
    {
        $this->trailRepository->expects($this->once())->method('get')->will($this->returnValue($this->trail));
        $service = new GetAuthor($this->trailRepository, $this->uuid, $this->logger);
        $this->assertEquals($this->trail, $service->run(), 'Success');
    }

    public function testGetAuthorServiceReturningException()
    {
        $this->logger->expects($this->once())->method('error');
        $this->trailRepository->expects($this->once())->method('get')->will($this->throwException(new Exception()));
        $service = new GetAuthor($this->trailRepository, $this->uuid, $this->logger);
        $this->assertEquals(false, $service->run(), 'Exception');
    }

    public function testGetAuthorServiceReturningFalse()
    {
        $this->trailRepository->expects($this->once())->method('get')->will($this->returnValue(false));
        $service = new GetAuthor($this->trailRepository, $this->uuid, $this->logger);
        $this->assertEquals(false, $service->run(), 'False');
    }

    public function testGetAuthorsListService()
    {
        $this->trailRepository->expects($this->once())->method('getList')->with($this->filters)->will($this->returnValue([$this->trail]));
        $service = new ListAuthors($this->trailRepository, $this->filters, $this->logger);
        $this->assertEquals([$this->trail], $service->run(), 'Success');
    }

    public function testGetAuthorsListServiceException()
    {
        $this->logger->expects($this->once())->method('error');
        $this->trailRepository->expects($this->once())->method('getList')->with($this->filters)->will($this->throwException(new Exception()));
        $service = new ListAuthors($this->trailRepository, $this->filters, $this->logger);
        $this->assertEquals([], $service->run(), 'Exception');
    }
}

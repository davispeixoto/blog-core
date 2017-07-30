<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 7/23/17
 * Time: 2:12 PM
 */

namespace DavisPeixoto\BlogCore\Tests\Services;

use DavisPeixoto\BlogCore\Entity\Tag;
use DavisPeixoto\BlogCore\Repository\AbstractTagRepository;
use DavisPeixoto\BlogCore\Service\CreateTag;
use DavisPeixoto\BlogCore\Service\DeleteTag;
use DavisPeixoto\BlogCore\Service\EditTag;
use DavisPeixoto\BlogCore\Service\GetTag;
use DavisPeixoto\BlogCore\Service\ListTags;
use Exception;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class TestTagServices extends TestCase
{
    /**
     * @LoggerInterface
     */
    private $logger;

    /**
     * @RepositoryInterface
     */
    private $tagRepository;

    /**
     * @UuidInterface
     */
    private $uuid;

    /**
     * @Tag
     */
    private $tag;

    /**
     * @array
     */
    private $filters;

    public function setUp()
    {
        $this->logger = $this->createMock(LoggerInterface::class);
        $this->tagRepository = $this->getMockForAbstractClass(AbstractTagRepository::class);
        $this->uuid = Uuid::uuid4();
        $this->tag = new Tag('Tag 1', $this->uuid);
        $this->filters = [];
    }

    public function testCreateTagService()
    {
        $this->tagRepository->expects($this->once())->method('save')->will($this->returnValue($this->uuid));
        $service = new CreateTag($this->tagRepository, $this->tag, $this->logger);
        $this->assertEquals($this->uuid, $service->run(), 'called once!');
    }

    public function testCreateTagServiceShouldReturnNullOnFailure()
    {
        $this->logger->expects($this->once())->method('error');
        $this->tagRepository->expects($this->once())->method('save')->will($this->throwException(new Exception()));
        $service = new CreateTag($this->tagRepository, $this->tag, $this->logger);
        $this->assertEquals(null, $service->run(), 'Test exception');
    }

    public function testEditTagService()
    {
        $this->tagRepository->expects($this->once())->method('save')->will($this->returnValue($this->uuid));
        $service = new EditTag($this->tagRepository, $this->tag, $this->logger);
        $this->assertEquals($this->uuid, $service->run(), 'called once!');
    }

    public function testEditTagServiceShouldReturnNullOnFailure()
    {
        $this->logger->expects($this->once())->method('error');
        $this->tagRepository->expects($this->once())->method('save')->will($this->throwException(new Exception()));
        $service = new EditTag($this->tagRepository, $this->tag, $this->logger);
        $this->assertEquals(null, $service->run(), 'Test exception');
    }

    public function testDeleteTagService()
    {
        $this->tagRepository->expects($this->once())->method('delete')->will($this->returnValue(true));
        $service = new DeleteTag($this->tagRepository, $this->tag, $this->logger);
        $this->assertEquals(true, $service->run(), 'Success');
    }

    public function testDeleteTagServiceReturningFalse()
    {
        $this->tagRepository->expects($this->once())->method('delete')->will($this->returnValue(false));
        $service = new DeleteTag($this->tagRepository, $this->tag, $this->logger);
        $this->assertEquals(false, $service->run(), 'Success');
    }

    public function testDeleteTagServiceShouldReturnFalseOnFailure()
    {
        $this->logger->expects($this->once())->method('error');
        $this->tagRepository->expects($this->once())->method('delete')->will($this->throwException(new Exception()));
        $service = new DeleteTag($this->tagRepository, $this->tag, $this->logger);
        $this->assertEquals(false, $service->run(), 'Test exception');
    }

    public function testGetTagService()
    {
        $this->tagRepository->expects($this->once())->method('get')->will($this->returnValue($this->tag));
        $service = new GetTag($this->tagRepository, $this->uuid, $this->logger);
        $this->assertEquals($this->tag, $service->run(), 'Success');
    }

    public function testGetTagServiceReturningException()
    {
        $this->logger->expects($this->once())->method('error');
        $this->tagRepository->expects($this->once())->method('get')->will($this->throwException(new Exception()));
        $service = new GetTag($this->tagRepository, $this->uuid, $this->logger);
        $this->assertEquals(false, $service->run(), 'Exception');
    }

    public function testGetTagServiceReturningFalse()
    {
        $this->tagRepository->expects($this->once())->method('get')->will($this->returnValue(false));
        $service = new GetTag($this->tagRepository, $this->uuid, $this->logger);
        $this->assertEquals(false, $service->run(), 'False');
    }

    public function testGetTagsListService()
    {
        $this->tagRepository->expects($this->once())->method('getList')->with($this->filters)->will($this->returnValue([$this->tag]));
        $service = new ListTags($this->tagRepository, $this->filters, $this->logger);
        $this->assertEquals([$this->tag], $service->run(), 'Success');
    }

    public function testGetTagsListServiceException()
    {
        $this->logger->expects($this->once())->method('error');
        $this->tagRepository->expects($this->once())->method('getList')->with($this->filters)->will($this->throwException(new Exception()));
        $service = new ListTags($this->tagRepository, $this->filters, $this->logger);
        $this->assertEquals([], $service->run(), 'Exception');
    }
}

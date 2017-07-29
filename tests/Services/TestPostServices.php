<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 7/23/17
 * Time: 2:12 PM
 */

namespace DavisPeixoto\BlogCore\Tests\Services;

use DavisPeixoto\BlogCore\Entity\Author;
use PHPUnit\Framework\TestCase;
use DavisPeixoto\BlogCore\Entity\Post;
use DavisPeixoto\BlogCore\Service\CreatePost;
use DavisPeixoto\BlogCore\Service\EditPost;
use DavisPeixoto\BlogCore\Service\DeletePost;
use DavisPeixoto\BlogCore\Service\GetPost;
use DavisPeixoto\BlogCore\Service\ListPosts;
use DavisPeixoto\BlogCore\Repository\AbstractPostRepository;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Psr\Log\LoggerInterface;
use DateTime;
use Exception;

class TestPostServices extends TestCase
{
    /**
     * @LoggerInterface
     */
    private $logger;

    /**
     * @RepositoryInterface
     */
    private $postRepository;

    /**
     * @UuidInterface
     */
    private $uuid;

    /**
     * @UuidInterface
     */
    private $authorUuid;

    /**
     * @Post
     */
    private $post;

    /**
     * @Author
     */
    private $author;

    /**
     * @array
     */
    private $filters;

    public function setUp()
    {
        $this->logger = $this->createMock(LoggerInterface::class);
        $this->postRepository = $this->getMockForAbstractClass(AbstractPostRepository::class);
        $this->uuid = Uuid::uuid4();
        $this->authorUuid = Uuid::uuid4();
        $this->author = new Author($this->authorUuid, 'Davis', 'email@example.org', 'Some string', new DateTime());
        $this->post = new Post($this->uuid, 'A Post', 'Lorem ipsum', $this->author, [], null);
        $this->filters = [];
    }

    public function testCreatePostService()
    {
        $this->postRepository->expects($this->once())->method('save')->will($this->returnValue($this->uuid));
        $service = new CreatePost($this->postRepository, $this->post, $this->logger);
        $this->assertEquals($this->uuid, $service->run(), 'called once!');
    }

    public function testCreatePostServiceShouldReturnNullOnFailure()
    {
        $this->logger->expects($this->once())->method('error');
        $this->postRepository->expects($this->once())->method('save')->will($this->throwException(new Exception()));
        $service = new CreatePost($this->postRepository, $this->post, $this->logger);
        $this->assertEquals(null, $service->run(), 'Test exception');
    }

    public function testEditPostService()
    {
        $this->postRepository->expects($this->once())->method('save')->will($this->returnValue($this->uuid));
        $service = new EditPost($this->postRepository, $this->post, $this->logger);
        $this->assertEquals($this->uuid, $service->run(), 'called once!');
    }

    public function testEditPostServiceShouldReturnNullOnFailure()
    {
        $this->logger->expects($this->once())->method('error');
        $this->postRepository->expects($this->once())->method('save')->will($this->throwException(new Exception()));
        $service = new EditPost($this->postRepository, $this->post, $this->logger);
        $this->assertEquals(null, $service->run(), 'Test exception');
    }

    public function testDeletePostService()
    {
        $this->postRepository->expects($this->once())->method('delete')->will($this->returnValue(true));
        $service = new DeletePost($this->postRepository, $this->post, $this->logger);
        $this->assertEquals(true, $service->run(), 'Success');
    }

    public function testDeletePostServiceReturningFalse()
    {
        $this->postRepository->expects($this->once())->method('delete')->will($this->returnValue(false));
        $service = new DeletePost($this->postRepository, $this->post, $this->logger);
        $this->assertEquals(false, $service->run(), 'Success');
    }

    public function testDeletePostServiceShouldReturnFalseOnFailure()
    {
        $this->logger->expects($this->once())->method('error');
        $this->postRepository->expects($this->once())->method('delete')->will($this->throwException(new Exception()));
        $service = new DeletePost($this->postRepository, $this->post, $this->logger);
        $this->assertEquals(false, $service->run(), 'Test exception');
    }

    public function testGetPostService()
    {
        $this->postRepository->expects($this->once())->method('get')->will($this->returnValue($this->post));
        $service = new GetPost($this->postRepository, $this->uuid, $this->logger);
        $this->assertEquals($this->post, $service->run(), 'Success');
    }

    public function testGetPostServiceReturningException()
    {
        $this->logger->expects($this->once())->method('error');
        $this->postRepository->expects($this->once())->method('get')->will($this->throwException(new Exception()));
        $service = new GetPost($this->postRepository, $this->uuid, $this->logger);
        $this->assertEquals(false, $service->run(), 'Exception');
    }

    public function testGetPostServiceReturningFalse()
    {
        $this->postRepository->expects($this->once())->method('get')->will($this->returnValue(false));
        $service = new GetPost($this->postRepository, $this->uuid, $this->logger);
        $this->assertEquals(false, $service->run(), 'False');
    }

    public function testGetPostsListService()
    {
        $this->postRepository->expects($this->once())->method('getList')->with($this->filters)->will($this->returnValue([$this->post]));
        $service = new ListPosts($this->postRepository, $this->filters, $this->logger);
        $this->assertEquals([$this->post], $service->run(), 'Success');
    }

    public function testGetPostsListServiceException()
    {
        $this->logger->expects($this->once())->method('error');
        $this->postRepository->expects($this->once())->method('getList')->with($this->filters)->will($this->throwException(new Exception()));
        $service = new ListPosts($this->postRepository, $this->filters, $this->logger);
        $this->assertEquals([], $service->run(), 'Exception');
    }
}

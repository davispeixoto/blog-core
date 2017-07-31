<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 7/23/17
 * Time: 2:12 PM
 */

namespace DavisPeixoto\BlogCore\Tests\Services;

use DateTime;
use DavisPeixoto\BlogCore\Entity\AbstractEntity;
use DavisPeixoto\BlogCore\Entity\Author;
use DavisPeixoto\BlogCore\Entity\Post;
use DavisPeixoto\BlogCore\Entity\Tag;
use DavisPeixoto\BlogCore\Entity\Trail;
use DavisPeixoto\BlogCore\Interfaces\RepositoryInterface;
use DavisPeixoto\BlogCore\Interfaces\ServiceInterface;
use DavisPeixoto\BlogCore\Repository\AbstractAuthorRepository;
use DavisPeixoto\BlogCore\Repository\AbstractPostRepository;
use DavisPeixoto\BlogCore\Repository\AbstractTagRepository;
use DavisPeixoto\BlogCore\Repository\AbstractTrailRepository;
use DavisPeixoto\BlogCore\Service\CreateAuthor;
use DavisPeixoto\BlogCore\Service\CreatePost;
use DavisPeixoto\BlogCore\Service\CreateTag;
use DavisPeixoto\BlogCore\Service\CreateTrail;
use DavisPeixoto\BlogCore\Service\DeleteAuthor;
use DavisPeixoto\BlogCore\Service\DeletePost;
use DavisPeixoto\BlogCore\Service\DeleteTag;
use DavisPeixoto\BlogCore\Service\DeleteTrail;
use DavisPeixoto\BlogCore\Service\EditAuthor;
use DavisPeixoto\BlogCore\Service\EditPost;
use DavisPeixoto\BlogCore\Service\EditTag;
use DavisPeixoto\BlogCore\Service\EditTrail;
use DavisPeixoto\BlogCore\Service\GetAuthor;
use DavisPeixoto\BlogCore\Service\GetPost;
use DavisPeixoto\BlogCore\Service\GetTag;
use DavisPeixoto\BlogCore\Service\GetTrail;
use DavisPeixoto\BlogCore\Service\ListAuthors;
use DavisPeixoto\BlogCore\Service\ListPosts;
use DavisPeixoto\BlogCore\Service\ListTags;
use DavisPeixoto\BlogCore\Service\ListTrails;
use Exception;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Ramsey\Uuid\Uuid;

class TestServices extends TestCase
{
    /**
     * @param RepositoryInterface $repository
     * @param AbstractEntity $entity
     * @param LoggerInterface $logger
     * @param ServiceInterface $serviceName
     * @param string $method
     * @param mixed $willReturn
     * @param string $expected
     * @param string $message
     * @dataProvider successServiceProvider
     */
    public function testIsSuccessService(
        $serviceName,
        $method,
        $willReturn,
        $repository,
        $entity,
        $logger,
        $expected,
        $message
    ) {
        $repository->expects($this->once())->method($method)->will($this->returnValue($willReturn));
        $service = new $serviceName($repository, $entity, $logger);
        $this->assertEquals($expected, $service->run(), $message);
    }

    /**
     * @param $serviceName
     * @param $method
     * @param $willReturn
     * @param $repository
     * @param $entity
     * @param $logger
     * @param $expected
     * @param $message
     * @dataProvider failureServiceProvider
     */
    public function testIsFailureService(
        $serviceName,
        $method,
        $willReturn,
        $repository,
        $entity,
        $logger,
        $expected,
        $message
    ) {
        $repository->expects($this->once())->method($method)->will($this->returnValue($willReturn));
        $service = new $serviceName($repository, $entity, $logger);
        $this->assertEquals($expected, $service->run(), $message);
    }

    /**
     * @param $serviceName
     * @param $method
     * @param $repository
     * @param $entity
     * @param $logger
     * @param $expected
     * @param $message
     * @dataProvider exceptionServiceProvider
     */
    public function testIsExceptionService($serviceName, $method, $repository, $entity, $logger, $expected, $message)
    {
        $logger->expects($this->once())->method('error');
        $repository->expects($this->once())->method($method)->will($this->throwException(new Exception()));
        $service = new $serviceName($repository, $entity, $logger);
        $this->assertEquals($expected, $service->run(), $message);
    }

    public function successServiceProvider()
    {
        $authorUuid = Uuid::uuid4()->toString();
        $postUuid = Uuid::uuid4()->toString();
        $tagUuid = Uuid::uuid4()->toString();
        $trailUuid = Uuid::uuid4()->toString();

        $author = new Author('Davis', 'email@example.org', 'Some string', $authorUuid, new DateTime());
        $post = new Post('A Post', 'Lorem ipsum', $author, $postUuid, [], null);
        $tag = new Tag('A tag', $tagUuid);
        $trail = new Trail('A trail', 'An amazing trail', $trailUuid, [$post]);
        $filters = [];

        return [
            [
                CreateAuthor::class,
                'save',
                $authorUuid,
                $this->getMockForAbstractClass(AbstractAuthorRepository::class),
                $author,
                $this->createMock(LoggerInterface::class),
                $authorUuid,
                'Create author service',
            ],
            [
                EditAuthor::class,
                'save',
                $authorUuid,
                $this->getMockForAbstractClass(AbstractAuthorRepository::class),
                $author,
                $this->createMock(LoggerInterface::class),
                $authorUuid,
                'Edit author service',
            ],
            [
                DeleteAuthor::class,
                'delete',
                true,
                $this->getMockForAbstractClass(AbstractAuthorRepository::class),
                $author,
                $this->createMock(LoggerInterface::class),
                true,
                'Delete author service',
            ],
            [
                GetAuthor::class,
                'get',
                $author,
                $this->getMockForAbstractClass(AbstractAuthorRepository::class),
                $authorUuid,
                $this->createMock(LoggerInterface::class),
                $author,
                'Get author service',
            ],
            [
                ListAuthors::class,
                'getList',
                [$author],
                $this->getMockForAbstractClass(AbstractAuthorRepository::class),
                $filters,
                $this->createMock(LoggerInterface::class),
                [$author],
                'List authors service',
            ],

            [
                CreatePost::class,
                'save',
                $postUuid,
                $this->getMockForAbstractClass(AbstractPostRepository::class),
                $post,
                $this->createMock(LoggerInterface::class),
                $postUuid,
                'Create post service',
            ],
            [
                EditPost::class,
                'save',
                $postUuid,
                $this->getMockForAbstractClass(AbstractPostRepository::class),
                $post,
                $this->createMock(LoggerInterface::class),
                $postUuid,
                'Edit post service',
            ],
            [
                DeletePost::class,
                'delete',
                true,
                $this->getMockForAbstractClass(AbstractPostRepository::class),
                $post,
                $this->createMock(LoggerInterface::class),
                true,
                'Delete post service',
            ],
            [
                GetPost::class,
                'get',
                $post,
                $this->getMockForAbstractClass(AbstractPostRepository::class),
                $postUuid,
                $this->createMock(LoggerInterface::class),
                $post,
                'Get post service',
            ],
            [
                ListPosts::class,
                'getList',
                [$post],
                $this->getMockForAbstractClass(AbstractPostRepository::class),
                $filters,
                $this->createMock(LoggerInterface::class),
                [$post],
                'List posts service',
            ],

            [
                CreateTag::class,
                'save',
                $tagUuid,
                $this->getMockForAbstractClass(AbstractTagRepository::class),
                $tag,
                $this->createMock(LoggerInterface::class),
                $tagUuid,
                'Create tag service',
            ],
            [
                EditTag::class,
                'save',
                $tagUuid,
                $this->getMockForAbstractClass(AbstractTagRepository::class),
                $tag,
                $this->createMock(LoggerInterface::class),
                $tagUuid,
                'Edit tag service',
            ],
            [
                DeleteTag::class,
                'delete',
                true,
                $this->getMockForAbstractClass(AbstractTagRepository::class),
                $tag,
                $this->createMock(LoggerInterface::class),
                true,
                'Delete tag service',
            ],
            [
                GetTag::class,
                'get',
                $tag,
                $this->getMockForAbstractClass(AbstractTagRepository::class),
                $tagUuid,
                $this->createMock(LoggerInterface::class),
                $tag,
                'Get tag service',
            ],
            [
                ListTags::class,
                'getList',
                [$tag],
                $this->getMockForAbstractClass(AbstractTagRepository::class),
                $filters,
                $this->createMock(LoggerInterface::class),
                [$tag],
                'List tags service',
            ],

            [
                CreateTrail::class,
                'save',
                $trailUuid,
                $this->getMockForAbstractClass(AbstractTrailRepository::class),
                $trail,
                $this->createMock(LoggerInterface::class),
                $trailUuid,
                'Create trail service',
            ],
            [
                EditTrail::class,
                'save',
                $trailUuid,
                $this->getMockForAbstractClass(AbstractTrailRepository::class),
                $trail,
                $this->createMock(LoggerInterface::class),
                $trailUuid,
                'Edit trail service',
            ],
            [
                DeleteTrail::class,
                'delete',
                true,
                $this->getMockForAbstractClass(AbstractTrailRepository::class),
                $trail,
                $this->createMock(LoggerInterface::class),
                true,
                'Delete trail service',
            ],
            [
                GetTrail::class,
                'get',
                $trail,
                $this->getMockForAbstractClass(AbstractTrailRepository::class),
                $trailUuid,
                $this->createMock(LoggerInterface::class),
                $trail,
                'Get trail service',
            ],
            [
                ListTrails::class,
                'getList',
                [$trail],
                $this->getMockForAbstractClass(AbstractTrailRepository::class),
                $filters,
                $this->createMock(LoggerInterface::class),
                [$trail],
                'List trails service',
            ],
        ];
    }

    public function failureServiceProvider()
    {
        $authorUuid = Uuid::uuid4()->toString();
        $postUuid = Uuid::uuid4()->toString();
        $tagUuid = Uuid::uuid4()->toString();
        $trailUuid = Uuid::uuid4()->toString();

        $author = new Author('Davis', 'email@example.org', 'Some string', $authorUuid, new DateTime());
        $post = new Post('A Post', 'Lorem ipsum', $author, $postUuid, [], null);
        $tag = new Tag('A tag', $tagUuid);
        $trail = new Trail('A trail', 'An amazing trail', $trailUuid, [$post]);
        $filters = [];

        return [
            [
                DeleteAuthor::class,
                'delete',
                false,
                $this->getMockForAbstractClass(AbstractAuthorRepository::class),
                $author,
                $this->createMock(LoggerInterface::class),
                false,
                'Delete author service',
            ],
            [
                GetAuthor::class,
                'get',
                null,
                $this->getMockForAbstractClass(AbstractAuthorRepository::class),
                $authorUuid,
                $this->createMock(LoggerInterface::class),
                null,
                'Get author service',
            ],
            [
                ListAuthors::class,
                'getList',
                [],
                $this->getMockForAbstractClass(AbstractAuthorRepository::class),
                $filters,
                $this->createMock(LoggerInterface::class),
                [],
                'List authors service',
            ],

            [
                DeletePost::class,
                'delete',
                false,
                $this->getMockForAbstractClass(AbstractPostRepository::class),
                $post,
                $this->createMock(LoggerInterface::class),
                false,
                'Delete post service',
            ],
            [
                GetPost::class,
                'get',
                null,
                $this->getMockForAbstractClass(AbstractPostRepository::class),
                $postUuid,
                $this->createMock(LoggerInterface::class),
                null,
                'Get post service',
            ],
            [
                ListPosts::class,
                'getList',
                [],
                $this->getMockForAbstractClass(AbstractPostRepository::class),
                $filters,
                $this->createMock(LoggerInterface::class),
                [],
                'List posts service',
            ],

            [
                DeleteTag::class,
                'delete',
                false,
                $this->getMockForAbstractClass(AbstractTagRepository::class),
                $tag,
                $this->createMock(LoggerInterface::class),
                false,
                'Delete tag service',
            ],
            [
                GetTag::class,
                'get',
                null,
                $this->getMockForAbstractClass(AbstractTagRepository::class),
                $tagUuid,
                $this->createMock(LoggerInterface::class),
                null,
                'Get tag service',
            ],
            [
                ListTags::class,
                'getList',
                [],
                $this->getMockForAbstractClass(AbstractTagRepository::class),
                $filters,
                $this->createMock(LoggerInterface::class),
                [],
                'List tags service',
            ],

            [
                DeleteTrail::class,
                'delete',
                false,
                $this->getMockForAbstractClass(AbstractTrailRepository::class),
                $trail,
                $this->createMock(LoggerInterface::class),
                false,
                'Delete trail service',
            ],
            [
                GetTrail::class,
                'get',
                null,
                $this->getMockForAbstractClass(AbstractTrailRepository::class),
                $trailUuid,
                $this->createMock(LoggerInterface::class),
                null,
                'Get trail service',
            ],
            [
                ListTrails::class,
                'getList',
                [],
                $this->getMockForAbstractClass(AbstractTrailRepository::class),
                $filters,
                $this->createMock(LoggerInterface::class),
                [],
                'List trails service',
            ],
        ];
    }

    public function exceptionServiceProvider()
    {
        $authorUuid = Uuid::uuid4()->toString();
        $postUuid = Uuid::uuid4()->toString();
        $tagUuid = Uuid::uuid4()->toString();
        $trailUuid = Uuid::uuid4()->toString();

        $author = new Author('Davis', 'email@example.org', 'Some string', $authorUuid, new DateTime());
        $post = new Post('A Post', 'Lorem ipsum', $author, $postUuid, [], null);
        $tag = new Tag('A tag', $tagUuid);
        $trail = new Trail('A trail', 'An amazing trail', $trailUuid, [$post]);
        $filters = [];

        return [
            [
                CreateAuthor::class,
                'save',
                $this->getMockForAbstractClass(AbstractAuthorRepository::class),
                $author,
                $this->createMock(LoggerInterface::class),
                null,
                'Create author service',
            ],
            [
                EditAuthor::class,
                'save',
                $this->getMockForAbstractClass(AbstractAuthorRepository::class),
                $author,
                $this->createMock(LoggerInterface::class),
                null,
                'Edit author service',
            ],
            [
                DeleteAuthor::class,
                'delete',
                $this->getMockForAbstractClass(AbstractAuthorRepository::class),
                $author,
                $this->createMock(LoggerInterface::class),
                false,
                'Delete author service',
            ],
            [
                GetAuthor::class,
                'get',
                $this->getMockForAbstractClass(AbstractAuthorRepository::class),
                $authorUuid,
                $this->createMock(LoggerInterface::class),
                null,
                'Get author service',
            ],
            [
                ListAuthors::class,
                'getList',
                $this->getMockForAbstractClass(AbstractAuthorRepository::class),
                $filters,
                $this->createMock(LoggerInterface::class),
                [],
                'List authors service',
            ],

            [
                CreatePost::class,
                'save',
                $this->getMockForAbstractClass(AbstractPostRepository::class),
                $post,
                $this->createMock(LoggerInterface::class),
                null,
                'Create post service',
            ],
            [
                EditPost::class,
                'save',
                $this->getMockForAbstractClass(AbstractPostRepository::class),
                $post,
                $this->createMock(LoggerInterface::class),
                null,
                'Edit post service',
            ],
            [
                DeletePost::class,
                'delete',
                $this->getMockForAbstractClass(AbstractPostRepository::class),
                $post,
                $this->createMock(LoggerInterface::class),
                false,
                'Delete post service',
            ],
            [
                GetPost::class,
                'get',
                $this->getMockForAbstractClass(AbstractPostRepository::class),
                $postUuid,
                $this->createMock(LoggerInterface::class),
                null,
                'Get post service',
            ],
            [
                ListPosts::class,
                'getList',
                $this->getMockForAbstractClass(AbstractPostRepository::class),
                $filters,
                $this->createMock(LoggerInterface::class),
                [],
                'List posts service',
            ],

            [
                CreateTag::class,
                'save',
                $this->getMockForAbstractClass(AbstractTagRepository::class),
                $tag,
                $this->createMock(LoggerInterface::class),
                null,
                'Create tag service',
            ],
            [
                EditTag::class,
                'save',
                $this->getMockForAbstractClass(AbstractTagRepository::class),
                $tag,
                $this->createMock(LoggerInterface::class),
                null,
                'Edit tag service',
            ],
            [
                DeleteTag::class,
                'delete',
                $this->getMockForAbstractClass(AbstractTagRepository::class),
                $tag,
                $this->createMock(LoggerInterface::class),
                false,
                'Delete tag service',
            ],
            [
                GetTag::class,
                'get',
                $this->getMockForAbstractClass(AbstractTagRepository::class),
                $tagUuid,
                $this->createMock(LoggerInterface::class),
                null,
                'Get tag service',
            ],
            [
                ListTags::class,
                'getList',
                $this->getMockForAbstractClass(AbstractTagRepository::class),
                $filters,
                $this->createMock(LoggerInterface::class),
                [],
                'List tags service',
            ],

            [
                CreateTrail::class,
                'save',
                $this->getMockForAbstractClass(AbstractTrailRepository::class),
                $trail,
                $this->createMock(LoggerInterface::class),
                null,
                'Create trail service',
            ],
            [
                EditTrail::class,
                'save',
                $this->getMockForAbstractClass(AbstractTrailRepository::class),
                $trail,
                $this->createMock(LoggerInterface::class),
                null,
                'Edit trail service',
            ],
            [
                DeleteTrail::class,
                'delete',
                $this->getMockForAbstractClass(AbstractTrailRepository::class),
                $trail,
                $this->createMock(LoggerInterface::class),
                false,
                'Delete trail service',
            ],
            [
                GetTrail::class,
                'get',
                $this->getMockForAbstractClass(AbstractTrailRepository::class),
                $trailUuid,
                $this->createMock(LoggerInterface::class),
                null,
                'Get trail service',
            ],
            [
                ListTrails::class,
                'getList',
                $this->getMockForAbstractClass(AbstractTrailRepository::class),
                $filters,
                $this->createMock(LoggerInterface::class),
                [],
                'List trails service',
            ],
        ];
    }
}

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
use DavisPeixoto\BlogCore\Interfaces\RepositoryInterface;
use DavisPeixoto\BlogCore\Repository\AbstractAuthorRepository;
use DavisPeixoto\BlogCore\Service\CreateAuthor;
use DavisPeixoto\BlogCore\Service\DeleteAuthor;
use DavisPeixoto\BlogCore\Service\EditAuthor;
use DavisPeixoto\BlogCore\Service\GetAuthor;
use DavisPeixoto\BlogCore\Service\ListAuthors;
use Exception;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class TestAuthorServices extends TestCase
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var RepositoryInterface
     */
    private $authorRepository;

    /**
     * @var UuidInterface
     */
    private $uuid;

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
        $this->authorRepository = $this->getMockForAbstractClass(AbstractAuthorRepository::class);
        $this->uuid = Uuid::uuid4()->toString();
        $this->author = new Author('Davis', 'email@example.org', 'Some string', $this->uuid, new DateTime());
        $this->filters = [];
    }

    public function testCreateAuthorService()
    {
        $this->authorRepository->expects($this->once())->method('save')->will($this->returnValue($this->uuid));
        $service = new CreateAuthor($this->authorRepository, $this->author, $this->logger);
        $this->assertEquals($this->uuid, $service->run(), 'called once!');
    }

    public function testCreateAuthorServiceShouldReturnNullOnFailure()
    {
        $this->logger->expects($this->once())->method('error');
        $this->authorRepository->expects($this->once())->method('save')->will($this->throwException(new Exception()));
        $service = new CreateAuthor($this->authorRepository, $this->author, $this->logger);
        $this->assertEquals(null, $service->run(), 'Test exception');
    }

    public function testEditAuthorService()
    {
        $this->authorRepository->expects($this->once())->method('save')->will($this->returnValue($this->uuid));
        $service = new EditAuthor($this->authorRepository, $this->author, $this->logger);
        $this->assertEquals($this->uuid, $service->run(), 'called once!');
    }

    public function testEditAuthorServiceShouldReturnNullOnFailure()
    {
        $this->logger->expects($this->once())->method('error');
        $this->authorRepository->expects($this->once())->method('save')->will($this->throwException(new Exception()));
        $service = new EditAuthor($this->authorRepository, $this->author, $this->logger);
        $this->assertEquals(null, $service->run(), 'Test exception');
    }

    public function testDeleteAuthorService()
    {
        $this->authorRepository->expects($this->once())->method('delete')->will($this->returnValue(true));
        $service = new DeleteAuthor($this->authorRepository, $this->author, $this->logger);
        $this->assertEquals(true, $service->run(), 'Success');
    }

    public function testDeleteAuthorServiceReturningFalse()
    {
        $this->authorRepository->expects($this->once())->method('delete')->will($this->returnValue(false));
        $service = new DeleteAuthor($this->authorRepository, $this->author, $this->logger);
        $this->assertEquals(false, $service->run(), 'Success');
    }

    public function testDeleteAuthorServiceShouldReturnFalseOnFailure()
    {
        $this->logger->expects($this->once())->method('error');
        $this->authorRepository->expects($this->once())->method('delete')->will($this->throwException(new Exception()));
        $service = new DeleteAuthor($this->authorRepository, $this->author, $this->logger);
        $this->assertEquals(false, $service->run(), 'Test exception');
    }

    public function testGetAuthorService()
    {
        $this->authorRepository->expects($this->once())->method('get')->will($this->returnValue($this->author));
        $service = new GetAuthor($this->authorRepository, $this->uuid, $this->logger);
        $this->assertEquals($this->author, $service->run(), 'Success');
    }

    public function testGetAuthorServiceReturningException()
    {
        $this->logger->expects($this->once())->method('error');
        $this->authorRepository->expects($this->once())->method('get')->will($this->throwException(new Exception()));
        $service = new GetAuthor($this->authorRepository, $this->uuid, $this->logger);
        $this->assertEquals(null, $service->run(), 'Exception');
    }

    public function testGetAuthorServiceReturningFalse()
    {
        $this->authorRepository->expects($this->once())->method('get')->will($this->returnValue(false));
        $service = new GetAuthor($this->authorRepository, $this->uuid, $this->logger);
        $this->assertEquals(null, $service->run(), 'False');
    }

    public function testGetAuthorsListService()
    {
        $this->authorRepository->expects($this->once())->method('getList')->with($this->filters)->will($this->returnValue([$this->author]));
        $service = new ListAuthors($this->authorRepository, $this->filters, $this->logger);
        $this->assertEquals([$this->author], $service->run(), 'Success');
    }

    public function testGetAuthorsListServiceException()
    {
        $this->logger->expects($this->once())->method('error');
        $this->authorRepository->expects($this->once())->method('getList')->with($this->filters)->will($this->throwException(new Exception()));
        $service = new ListAuthors($this->authorRepository, $this->filters, $this->logger);
        $this->assertEquals([], $service->run(), 'Exception');
    }
}

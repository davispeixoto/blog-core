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

class TestAuthorServices extends TestCase
{
    public function testShouldCreateAuthorService()
    {
        $logger = $this->createMock(LoggerInterface::class);
        $uuidInterface = $this->createMock(UuidInterface::class);
        $author = new Author(Uuid::uuid4(), 'Davis', 'email@example.org', 'Some string', new DateTime());
        $authorRepo = $this->getMockForAbstractClass(AbstractAuthorRepository::class);
        $authorRepo->expects($this->once())->method('save')->will($this->returnValue($uuidInterface));
        $service = new CreateAuthor($authorRepo, $author, $logger);
        $this->assertEquals($uuidInterface, $service->run(), 'called once!');
    }
}

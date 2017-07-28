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
use DateTime;

class TestAuthorServices extends TestCase
{
    public function testShouldCreateAuthorService()
    {
        $authorRepo = 1;
        $logger = 2;
        $author = new Author(Uuid::uuid4(), 'Davis', 'email@example.org', 'Some string', new DateTime());
        $service = new CreateAuthor($authorRepo, $author, $logger);
        $this->assertEquals($expected, $service->run(), $message);
    }
}

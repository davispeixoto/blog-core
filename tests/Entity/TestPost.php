<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 7/23/17
 * Time: 7:25 PM
 */

namespace DavisPeixoto\BlogCore\Tests\Entity;

use DateTime;
use DavisPeixoto\BlogCore\Entity\Post;
use DavisPeixoto\BlogCore\Entity\Author;
use DavisPeixoto\BlogCore\Entity\Tag;
use PHPUnit_Framework_TestCase;
use Ramsey\Uuid\Uuid;

class TestPost extends PHPUnit_Framework_TestCase
{
    /**
     * @param $uuid
     * @param $title
     * @param $body
     * @param $author
     * @param $tags
     * @param $publishDate
     * @param $expected
     * @param $message
     * @dataProvider postConstructor
     */
    public function testConstructor($uuid, $title, $body, $author, $tags, $publishDate, $expected, $message)
    {
        $post = new Post($uuid, $title, $body, $author, $tags, $publishDate);
        $this->assertInstanceOf($expected, $post, $message);
    }

    public function postConstructor()
    {
        return [
            [Uuid::uuid4(), 'A Post', 'Lorem ipsum', new Author(Uuid::uuid4(), 'Davis', 'email@example.org', 'Some string', new DateTime()), [], null, Post::class, 'no tags, no publish date'],
            [Uuid::uuid4(), 'A Post', 'Lorem ipsum', new Author(Uuid::uuid4(), 'Davis', 'email@example.org', 'Some string', new DateTime()), [new Tag(Uuid::uuid4(),'tag1'), new Tag(Uuid::uuid4(),'tag2')], null, Post::class, 'have tags, unpublished'],
            [Uuid::uuid4(), 'A Post', 'Lorem ipsum', new Author(Uuid::uuid4(), 'Davis', 'email@example.org', 'Some string', new DateTime()), [], new DateTime(), Post::class, 'no tags, published'],
            [Uuid::uuid4(), 'A Post', 'Lorem ipsum', new Author(Uuid::uuid4(), 'Davis', 'email@example.org', 'Some string', new DateTime()), [new Tag(Uuid::uuid4(),'tag1'), new Tag(Uuid::uuid4(),'tag2')], new DateTime(), Post::class, 'tags, published (most common scenario)']
        ];
    }
}

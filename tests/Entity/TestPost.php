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
     * @Post $post
     */
    private $post;

    public function setUp()
    {
        $this->post = new Post(Uuid::uuid4(), 'A Post', 'Lorem ipsum', new Author(Uuid::uuid4(), 'Davis', 'email@example.org', 'Some string', new DateTime()), [], null);
    }

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

    /**
     * @param $date
     * @param $expected
     * @param $message
     * @dataProvider publishDateProvider
     */
    public function testPublishDates($date, $expected, $message)
    {
        $this->post->setPublishDate($date);
        $this->assertEquals($expected, $this->post->getPublishDate(), $message);
    }

    /**
     * @param $tag
     * @param $expected
     * @param $message
     * @dataProvider addTagProvider
     */
    public function testAddTag($tag, $expected, $message)
    {
        $this->post->addTag($tag);
        $this->assertEquals($expected, $this->post->getTags(), $message);
    }

    /**
     * @param $tags
     * @param $tag
     * @param $expected
     * @param $message
     * @dataProvider removeTagProvider
     */
    public function testRemoveTag($tags, $tag, $expected, $message)
    {
        $this->post->setTags($tags);
        $this->post->removeTag($tag);
        $this->assertEquals($expected, $this->post->getTags(), $message);
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

    public function publishDateProvider()
    {
        $date1 = new DateTime();

        return [
            [null, null, 'Null test'],
            [$date1, $date1, 'Positive test']
        ];
    }

    public function addTagProvider()
    {
        return [
            [],
        ];
    }

    public function removeTagProvider()
    {
        return [
            [],
        ];
    }
}

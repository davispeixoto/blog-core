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
use DavisPeixoto\BlogCore\Entity\Trail;
use PHPUnit_Framework_TestCase;
use Ramsey\Uuid\Uuid;

class TestTrail extends PHPUnit_Framework_TestCase
{
    /**
     * @Trail $trail
     */
    private $trail;

    public function setUp()
    {
        $this->trail = new Trail(Uuid::uuid4(), 'A Trail', 'Lorem ipsum sit dolor amet', []);
    }

    /**
     * @param $uuid
     * @param $name
     * @param $description
     * @param $posts
     * @param $expected
     * @param $message
     * @dataProvider trailConstructor
     */
    public function testConstructor($uuid, $name, $description, $posts, $expected, $message)
    {
        $post = new Post($uuid, $name, $description, $posts);
        $this->assertInstanceOf($expected, $post, $message);
    }

    /**
     * @param $posts
     * @param $post
     * @param $expected
     * @param $message
     * @dataProvider addPostProvider
     */
    public function testAddTag($posts, $post, $expected, $message)
    {
        $this->trail->setPosts($posts);
        $this->trail->addPost($post);
        $this->assertEquals($expected, $this->trail->getPosts(), $message);
    }

    /**
     * @param $posts
     * @param $post
     * @param $expected
     * @param $message
     * @dataProvider removePostProvider
     */
    public function testRemovePost($posts, $post, $expected, $message)
    {
        $this->trail->setPosts($posts);
        $this->trail->removePost($post);
        $this->assertEquals($expected, $this->trail->getPosts(), $message);
    }

    public function trailConstructor()
    {
        return [
            [Uuid::uuid4(), 'A Post', 'Lorem ipsum', new Author(Uuid::uuid4(), 'Davis', 'email@example.org', 'Some string', new DateTime()), [], null, Post::class, 'no tags, no publish date'],
            [Uuid::uuid4(), 'A Post', 'Lorem ipsum', new Author(Uuid::uuid4(), 'Davis', 'email@example.org', 'Some string', new DateTime()), [new Tag(Uuid::uuid4(),'tag1'), new Tag(Uuid::uuid4(),'tag2')], null, Post::class, 'have tags, unpublished'],
            [Uuid::uuid4(), 'A Post', 'Lorem ipsum', new Author(Uuid::uuid4(), 'Davis', 'email@example.org', 'Some string', new DateTime()), [], new DateTime(), Post::class, 'no tags, published'],
            [Uuid::uuid4(), 'A Post', 'Lorem ipsum', new Author(Uuid::uuid4(), 'Davis', 'email@example.org', 'Some string', new DateTime()), [new Tag(Uuid::uuid4(),'tag1'), new Tag(Uuid::uuid4(),'tag2')], new DateTime(), Post::class, 'tags, published (most common scenario)']
        ];
    }

    public function addPostProvider()
    {
        $tag1 = new Tag(Uuid::uuid4(), 'tag 1');
        $tag2 = new Tag(Uuid::uuid4(), 'tag 2');

        return [
            [[], $tag1, [$tag1], 'positive test, on null, first tag added'],
            [[$tag1], $tag2, [$tag1, $tag2], 'positive test, adding a new tag to existing tag vector'],
            [[$tag1, $tag2], $tag1, [$tag1, $tag2], 'negative test, tags should not be duplicated']
        ];
    }

    public function removePostProvider()
    {
        $tag1 = new Tag(Uuid::uuid4(), 'tag 1');
        $tag2 = new Tag(Uuid::uuid4(), 'tag 2');

        return [
            [[$tag1], $tag1, [], 'positive test, all tags removed'],
            [[$tag1, $tag2], $tag1, [$tag2], 'positive test, removing one tag'],
            [[$tag1], $tag2, [$tag1], 'negative test, removing non-existent tag']
        ];
    }
}

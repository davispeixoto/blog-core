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
use DavisPeixoto\BlogCore\Entity\Trail;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class TestTrail extends TestCase
{
    /**
     * @Trail $trail
     */
    private $trail;

    /**
     * @Post $post1
     */
    private $post1;

    /**
     * @Post $post2
     */
    private $post2;

    public function setUp()
    {
        $this->post1 = new Post(Uuid::uuid4(), 'Post 1', 'Lorem ipsum', new Author(Uuid::uuid4(), 'Davis', 'email@example.org', 'Some string', new DateTime()), [], null);
        $this->post2 = new Post(Uuid::uuid4(), 'Post 2', 'Lorem ipsum', new Author(Uuid::uuid4(), 'John Doe', 'email@example.org', 'Some string', new DateTime()), [], null);
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
        $post = new Trail($uuid, $name, $description, $posts);
        $this->assertInstanceOf($expected, $post, $message);
    }

    /**
     * @param $posts
     * @param $post
     * @param $expected
     * @param $message
     * @dataProvider addPostProvider
     */
    public function testAddPost($posts, $post, $expected, $message)
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
        $this->setUp();
        return [
            [Uuid::uuid4(), 'A Trail', 'Lorem ipsum sit dolor amet', [], Trail::class, 'no posts'],
            [Uuid::uuid4(), 'A Trail', 'Lorem ipsum sit dolor amet', [$this->post1], Trail::class, 'one post'],
            [Uuid::uuid4(), 'A Trail', 'Lorem ipsum sit dolor amet', [$this->post1, $this->post2], Trail::class, 'more posts'],
        ];
    }

    public function addPostProvider()
    {
        $this->setUp();
        return [
            [[], $this->post1, [$this->post1], 'positive test, on null, first post added'],
            [[$this->post1], $this->post2, [$this->post1, $this->post2], 'positive test, adding a new post to existing posts vector'],
            [[$this->post1, $this->post2], $this->post1, [$this->post1, $this->post2], 'negative test, posts should not be duplicated']
        ];
    }

    public function removePostProvider()
    {
        $this->setUp();
        return [
            [[$this->post1], $this->post1, [], 'positive test, all tags removed'],
            [[$this->post1, $this->post2], $this->post1, [$this->post2], 'positive test, removing one tag'],
            [[$this->post1], $this->post2, [$this->post1], 'negative test, removing non-existent tag']
        ];
    }
}

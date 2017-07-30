<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 7/23/17
 * Time: 7:25 PM
 */

namespace DavisPeixoto\BlogCore\Tests\Entity;

use DateTime;
use DavisPeixoto\BlogCore\Entity\Author;
use DavisPeixoto\BlogCore\Entity\Post;
use DavisPeixoto\BlogCore\Entity\Tag;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class TestPost extends TestCase
{
    /**
     * @Post $post
     */
    private $post;

    public function setUp()
    {
        $this->post = new Post('A Post', 'Lorem ipsum', new Author('Davis', 'email@example.org',
            'Some string', Uuid::uuid4(), new DateTime()), Uuid::uuid4(), [], null);
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
        $post = new Post($title, $body, $author, $uuid, $tags, $publishDate);
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
     * @param $tags
     * @param $tag
     * @param $expected
     * @param $message
     * @dataProvider addTagProvider
     */
    public function testAddTag($tags, $tag, $expected, $message)
    {
        $this->post->setTags($tags);
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
            [
                Uuid::uuid4(),
                'A Post',
                'Lorem ipsum',
                new Author('Davis', 'email@example.org', 'Some string',
                    Uuid::uuid4(), new DateTime()),
                [],
                null,
                Post::class,
                'no tags, no publish date',
            ],
            [
                Uuid::uuid4(),
                'A Post',
                'Lorem ipsum',
                new Author('Davis', 'email@example.org', 'Some string',
                    Uuid::uuid4(), new DateTime()),
                [new Tag('tag1', Uuid::uuid4()), new Tag('tag2', Uuid::uuid4())],
                null,
                Post::class,
                'have tags, unpublished',
            ],
            [
                Uuid::uuid4(),
                'A Post',
                'Lorem ipsum',
                new Author('Davis', 'email@example.org', 'Some string',
                    Uuid::uuid4(), new DateTime()),
                [],
                new DateTime(),
                Post::class,
                'no tags, published',
            ],
            [
                Uuid::uuid4(),
                'A Post',
                'Lorem ipsum',
                new Author('Davis', 'email@example.org', 'Some string',
                    Uuid::uuid4(), new DateTime()),
                [new Tag('tag1', Uuid::uuid4()), new Tag('tag2', Uuid::uuid4())],
                new DateTime(),
                Post::class,
                'tags, published (most common scenario)',
            ]
        ];
    }

    public function publishDateProvider()
    {
        $date1 = new DateTime();

        return [
            [null, null, 'Null Test'],
            [$date1, $date1, 'Positive Test']
        ];
    }

    public function addTagProvider()
    {
        $tag1 = new Tag('tag 1', null);
        $tag2 = new Tag('tag 2', Uuid::uuid4()->toString());

        return [
            [[], $tag1, [$tag1], 'positive test, on null, first tag added'],
            [[$tag1], $tag2, [$tag1, $tag2], 'positive test, adding a new tag to existing tag vector'],
            [[$tag1, $tag2], $tag1, [$tag1, $tag2], 'negative test, tags should not be duplicated']
        ];
    }

    public function removeTagProvider()
    {
        $tag1 = new Tag('tag 1', '');
        $tag2 = new Tag('tag 2', null);

        return [
            [[$tag1], $tag1, [], 'positive test, all tags removed'],
            [[$tag1, $tag2], $tag1, [$tag2], 'positive test, removing one tag'],
            [[$tag1], $tag2, [$tag1], 'negative test, removing non-existent tag']
        ];
    }
}

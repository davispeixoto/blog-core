<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 7/23/17
 * Time: 3:04 AM
 */

namespace DavisPeixoto\Entity;


use DateTime;
use Ramsey\Uuid\Uuid;
use stdClass;

class Post extends stdClass
{
    /**
     * @var Uuid
     */
    private $postId;

    /**
     * @var string $title
     */
    private $title;

    /**
     * @var string $body
     */
    private $body;

    /**
     * @var DateTime
     */
    private $publishDate;

    /**
     * @var Author
     */
    private $authorId;

    /**
     * @var Tag[]
     */
    private $tags;

    /**
     * Post constructor.
     * @param Uuid $postId
     * @param string $title
     * @param string $body
     * @param DateTime $publishDate
     * @param Author $authorId
     * @param Tag[]|null $tags
     */
    public function __construct(Uuid $postId, $title, $body, DateTime $publishDate, Author $authorId, array $tags = [])
    {
        $this->postId = $postId;
        $this->title = $title;
        $this->body = $body;
        $this->publishDate = $publishDate;
        $this->authorId = $authorId;
        $this->tags = $tags;
    }

    /**
     * @return Uuid
     */
    public function getPostId(): Uuid
    {
        return $this->postId;
    }

    /**
     * @param Uuid $postId
     */
    public function setPostId(Uuid $postId)
    {
        $this->postId = $postId;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param string $body
     */
    public function setBody(string $body)
    {
        $this->body = $body;
    }

    /**
     * @return DateTime
     */
    public function getPublishDate(): DateTime
    {
        return $this->publishDate;
    }

    /**
     * @param DateTime $publishDate
     */
    public function setPublishDate(DateTime $publishDate)
    {
        $this->publishDate = $publishDate;
    }

    /**
     * @return Author
     */
    public function getAuthorId(): Author
    {
        return $this->authorId;
    }

    /**
     * @param Author $authorId
     */
    public function setAuthorId(Author $authorId)
    {
        $this->authorId = $authorId;
    }

    /**
     * @return Tag[]
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @param Tag[] $tags
     */
    public function setTags(array $tags)
    {
        $this->tags = array_unique($tags);
    }

    public function addTag(Tag $tag)
    {
        $tags = $this->tags;
        $tags[] = $tag;
        $this->setTags($tags);

        return $this;
    }

    public function removeTag(Tag $tag)
    {
        foreach ($this->getTags() as $key => $value) {
            if ($value->getTagId() === $tag->getTagId()) {
                unset($this->tags[$key]);

                return $this;
            }
        }

        return $this;
    }
}

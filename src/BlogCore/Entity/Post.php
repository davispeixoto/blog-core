<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 7/23/17
 * Time: 3:04 AM
 */

namespace DavisPeixoto\BlogCore\Entity;


use DateTime;
use Ramsey\Uuid\UuidInterface;
use stdClass;

/**
 * Class Post
 * @package DavisPeixoto\BlogCore\Entity
 */
class Post extends stdClass
{
    /**
     * @var UuidInterface
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
     * @param UuidInterface $postId
     * @param string $title
     * @param string $body
     * @param DateTime $publishDate
     * @param Author $authorId
     * @param Tag[]|null $tags
     */
    public function __construct(
        UuidInterface $postId,
        $title,
        $body,
        DateTime $publishDate,
        Author $authorId,
        array $tags = []
    ) {
        $this->postId = $postId;
        $this->title = $title;
        $this->body = $body;
        $this->publishDate = $publishDate;
        $this->authorId = $authorId;
        $this->tags = $tags;
    }

    /**
     * @codeCoverageIgnore
     * @return UuidInterface
     */
    public function getPostId(): UuidInterface
    {
        return $this->postId;
    }

    /**
     * @codeCoverageIgnore
     * @param UuidInterface $postId
     */
    public function setPostId(UuidInterface $postId)
    {
        $this->postId = $postId;
    }

    /**
     * @codeCoverageIgnore
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @codeCoverageIgnore
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @codeCoverageIgnore
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @codeCoverageIgnore
     * @param string $body
     */
    public function setBody(string $body)
    {
        $this->body = $body;
    }

    /**
     * @codeCoverageIgnore
     * @return DateTime
     */
    public function getPublishDate(): DateTime
    {
        return $this->publishDate;
    }

    /**
     * @codeCoverageIgnore
     * @param DateTime $publishDate
     */
    public function setPublishDate(DateTime $publishDate)
    {
        $this->publishDate = $publishDate;
    }

    /**
     * @codeCoverageIgnore
     * @return Author
     */
    public function getAuthorId(): Author
    {
        return $this->authorId;
    }

    /**
     * @codeCoverageIgnore
     * @param Author $authorId
     */
    public function setAuthorId(Author $authorId)
    {
        $this->authorId = $authorId;
    }

    /**
     * @codeCoverageIgnore
     * @return Tag[]
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @codeCoverageIgnore
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

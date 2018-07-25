<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 7/23/17
 * Time: 3:04 AM
 */

namespace DavisPeixoto\BlogCore\Entity;

use DateTime;
use Ramsey\Uuid\Exception\InvalidUuidStringException;

/**
 * Class Post
 * @package DavisPeixoto\BlogCore\Entity
 */
class Post extends AbstractEntity
{
    /**
     * @var string $title
     */
    private $title;

    /**
     * @var string $body
     */
    private $body;

    /**
     * @var DateTime|null
     */
    private $publishDate;

    /**
     * @var Author
     */
    private $author;

    /**
     * @var Tag[]
     */
    private $tags;

    /**
     * Post constructor.
     * @param string $title
     * @param string $body
     * @param Author $authorId
     * @param string|null $id
     * @param Tag[] $tags
     * @param DateTime|null $publishDate
     * @throws InvalidUuidStringException
     */
    public function __construct(
        string $title,
        string $body,
        Author $authorId,
        string $id = null,
        array $tags = [],
        DateTime $publishDate = null
    ) {
        $this->setId($id);
        $this->setTitle($title);
        $this->setBody($body);
        $this->setPublishDate($publishDate);
        $this->setAuthor($authorId);
        $this->setTags($tags);
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
     * @return DateTime|null
     */
    public function getPublishDate()
    {
        return $this->publishDate;
    }

    /**
     * @param DateTime|null $publishDate
     */
    public function setPublishDate(DateTime $publishDate = null)
    {
        $this->publishDate = $publishDate;
    }

    /**
     * @codeCoverageIgnore
     * @return Author
     */
    public function getAuthor(): Author
    {
        return $this->author;
    }

    /**
     * @codeCoverageIgnore
     * @param Author $author
     */
    public function setAuthor(Author $author)
    {
        $this->author = $author;
    }

    /**
     * @return Tag[]
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @param Tag[]|array $tags
     */
    public function setTags(array $tags = [])
    {
        $this->tags = array_unique($tags, SORT_REGULAR);
    }

    /**
     * @param Tag $tag
     * @return $this
     */
    public function addTag(Tag $tag)
    {
        $tags = $this->getTags();
        $tags[] = $tag;
        $this->setTags($tags);

        return $this;
    }

    /**
     * @param Tag $tag
     * @return $this
     */
    public function removeTag(Tag $tag)
    {
        foreach ($this->getTags() as $key => $value) {
            if ($value->getId() === $tag->getId()) {
                unset($this->tags[$key]);
                sort($this->tags);

                return $this;
            }
        }

        return $this;
    }
}

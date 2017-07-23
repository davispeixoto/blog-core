<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 7/23/17
 * Time: 3:05 AM
 */

namespace DavisPeixoto\BlogCore\Entity;


use Ramsey\Uuid\UuidInterface;
use stdClass;

/**
 * Class Tag
 * @package DavisPeixoto\Entity
 */
class Tag extends stdClass
{
    /**
     * @var UuidInterface
     */
    private $tagId;
    /**
     * @var string
     */
    private $tagName;

    /**
     * Tag constructor.
     * @param UuidInterface $tagId
     * @param string $tagName
     */
    public function __construct(UuidInterface $tagId, string $tagName)
    {
        $this->tagId = $tagId;
        $this->tagName = $tagName;
    }

    /**
     * @codeCoverageIgnore
     * @return UuidInterface
     */
    public function getTagId(): UuidInterface
    {
        return $this->tagId;
    }

    /**
     * @codeCoverageIgnore
     * @param UuidInterface $tagId
     */
    public function setTagId(UuidInterface $tagId)
    {
        $this->tagId = $tagId;
    }

    /**
     * @codeCoverageIgnore
     * @return string
     */
    public function getTagName(): string
    {
        return $this->tagName;
    }

    /**
     * @codeCoverageIgnore
     * @param string $tagName
     */
    public function setTagName(string $tagName)
    {
        $this->tagName = $tagName;
    }

}

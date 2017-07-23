<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 7/23/17
 * Time: 3:05 AM
 */

namespace DavisPeixoto\Entity;


use Ramsey\Uuid\Uuid;
use stdClass;

/**
 * Class Tag
 * @package DavisPeixoto\Entity
 */
class Tag extends stdClass
{
    /**
     * @var Uuid
     */
    private $tagId;
    /**
     * @var string
     */
    private $tagName;

    /**
     * Tag constructor.
     * @param Uuid $tagId
     * @param string $tagName
     */
    public function __construct(Uuid $tagId, string $tagName)
    {
        $this->tagId = $tagId;
        $this->tagName = $tagName;
    }

    /**
     * @codeCoverageIgnore
     * @return Uuid
     */
    public function getTagId(): Uuid
    {
        return $this->tagId;
    }

    /**
     * @codeCoverageIgnore
     * @param Uuid $tagId
     */
    public function setTagId(Uuid $tagId)
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
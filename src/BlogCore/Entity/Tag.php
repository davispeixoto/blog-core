<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 7/23/17
 * Time: 3:05 AM
 */

namespace DavisPeixoto\BlogCore\Entity;

use Ramsey\Uuid\Exception\InvalidUuidStringException;

/**
 * Class Tag
 * @package DavisPeixoto\BlogCore\Entity
 */
class Tag extends AbstractEntity
{
    /**
     * @var string
     */
    private $tagName;

    /**
     * Tag constructor.
     * @param string $tagName
     * @param string|null $id
     * @throws InvalidUuidStringException
     * @codeCoverageIgnore
     */
    public function __construct(string $tagName, string $id = null)
    {
        $this->setId($id);
        $this->setTagName($tagName);
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

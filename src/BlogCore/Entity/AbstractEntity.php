<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 7/30/17
 * Time: 1:27 PM
 */

namespace DavisPeixoto\BlogCore\Entity;


use Ramsey\Uuid\Exception\InvalidUuidStringException;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use stdClass;

class AbstractEntity extends stdClass
{
    /**
     * @var UuidInterface
     */
    protected $id;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id->toString();
    }

    /**
     * @param string|null $id
     * @return $this
     * @throws InvalidUuidStringException
     */
    public function setId($id = null)
    {
        $uuid = null;
        if ($id === null || $id === '') {
            $uuid = Uuid::uuid4();
        } else {
            if (Uuid::isValid($id)) {
                $uuid = Uuid::fromString($id);
            } else {
                throw new InvalidUuidStringException();
            }
        }

        if ($uuid->getVersion() !== Uuid::uuid4()->getVersion()) {
            throw new InvalidUuidStringException();
        }

        $this->id = $uuid;

        return $this;
    }
}

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

abstract class AbstractEntity extends stdClass
{
    const UUID_TYPE_RANDOM = 4;

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
     * @throws InvalidUuidStringException
     */
    public function setId(string $id = null)
    {
        if ($id === null || $id === '') {
            $this->id = Uuid::uuid4();
        } else {
            $this->id = $this->isVersionValid(Uuid::fromString($this->isValidString($id)));
        }
    }

    /**
     * @param string $id
     * @return string
     * @throws InvalidUuidStringException
     */
    private function isValidString(string $id): string
    {
        if (!Uuid::isValid($id)) {
            throw new InvalidUuidStringException('Invalid string');
        }

        return $id;
    }

    /**
     * @param UuidInterface $uuid
     * @return UuidInterface
     * @throws InvalidUuidStringException
     */
    private function isVersionValid(UuidInterface $uuid): UuidInterface
    {
        if ($uuid->getVersion() !== self::UUID_TYPE_RANDOM) {
            throw new InvalidUuidStringException('Not supported version: '.$uuid->getVersion());
        }

        return $uuid;
    }
}

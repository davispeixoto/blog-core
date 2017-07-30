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
     * @throws InvalidUuidStringException
     */
    public function setId(string $id = null)
    {
        if ($id === null || $id === '') {
            $uuid = Uuid::uuid4();
        } else {
            if (Uuid::isValid($id)) {
                $uuid = Uuid::fromString($id);
            } else {
                throw new InvalidUuidStringException('Invalid string');
            }
        }

        if ($uuid->getVersion() !== Uuid::uuid4()->getVersion()) {
            throw new InvalidUuidStringException('Not supported version: '.$uuid->getVersion());
        }

        $this->id = $uuid;
    }
}

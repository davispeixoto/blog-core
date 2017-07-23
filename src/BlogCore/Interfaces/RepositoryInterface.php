<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 7/23/17
 * Time: 3:03 AM
 */

namespace DavisPeixoto\BlogCore\Interfaces;

use Exception;
use Ramsey\Uuid\UuidInterface;
use stdClass;

/**
 * Interface RepositoryInterface
 * @package DavisPeixoto\BlogCore\Interfaces
 * @codeCoverageIgnore
 */
interface RepositoryInterface
{
    /**
     * Must receive an entity to be saved
     * Should return the Uuid of created/updated object
     * Or throws an exception
     *
     * @param stdClass $obj
     * @throws Exception
     * @return UuidInterface
     */
    public function save(stdClass $obj): UuidInterface;

    /**
     * Must receive the entity to be deleted
     * Should return true in case of success
     * Should return false in case of failure
     *
     * @param stdClass $obj
     * @throws Exception
     * @return boolean
     */
    public function delete(stdClass $obj): bool;

    /**
     * Should receive an array of filters
     * Should return an array of entities
     *
     * @param array $filters
     * @return stdClass[]
     */
    public function getList(array $filters): array;

    /**
     * Should return a single entity
     * Looking up by Uuid
     *
     * @param UuidInterface $uuid
     * @return stdClass
     */
    public function get(UuidInterface $uuid): stdClass;
}

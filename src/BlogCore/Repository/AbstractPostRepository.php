<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 7/23/17
 * Time: 1:00 PM
 */

namespace DavisPeixoto\BlogCore\Repository;

use DavisPeixoto\BlogCore\Interfaces\RepositoryInterface;

/**
 * Class AbstractPostRepository
 * @package DavisPeixoto\BlogCore\Repository
 * @codeCoverageIgnore
 */
abstract class AbstractPostRepository implements RepositoryInterface
{
    public function getBySlang() {}
}

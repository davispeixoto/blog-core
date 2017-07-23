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
 * Class PostRepository
 * @package DavisPeixoto\BlogCore\Repository
 * @codeCoverageIgnore
 */
abstract class PostRepository implements RepositoryInterface
{
    public function getBySlang() {}
}

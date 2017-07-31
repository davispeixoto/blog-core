<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 7/30/17
 * Time: 7:21 PM
 */

namespace DavisPeixoto\BlogCore\Service;


use DavisPeixoto\BlogCore\Interfaces\ServiceInterface;
use Exception;

/**
 * Class AbstractDeleteService
 * @package DavisPeixoto\BlogCore\Service
 */
abstract class AbstractDeleteService extends AbstractWriteService implements ServiceInterface
{
    /**
     * @return boolean
     */
    public function run(): bool
    {
        try {
            return $this->repository->delete($this->entity);
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
        }

        return false;
    }
}

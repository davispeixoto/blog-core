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
 * Class AbstractSaveService
 * @package DavisPeixoto\BlogCore\Service
 */
abstract class AbstractSaveService extends AbstractWriteService implements ServiceInterface
{
    /**
     * @return string|null
     */
    public function run()
    {
        try {
            return $this->repository->save($this->entity);
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
        }

        return null;
    }
}

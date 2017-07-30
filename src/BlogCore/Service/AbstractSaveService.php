<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 7/30/17
 * Time: 7:21 PM
 */

namespace DavisPeixoto\BlogCore\Service;


use DavisPeixoto\BlogCore\Entity\AbstractEntity;
use DavisPeixoto\BlogCore\Interfaces\RepositoryInterface;
use DavisPeixoto\BlogCore\Interfaces\ServiceInterface;
use Exception;
use Psr\Log\LoggerInterface;

/**
 * Class AbstractSaveService
 * @package DavisPeixoto\BlogCore\Service
 */
abstract class AbstractSaveService implements ServiceInterface
{
    /**
     * @var RepositoryInterface
     */
    protected $repository;

    /**
     * @var AbstractEntity
     */
    protected $entity;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * CreateAuthor constructor.
     * @param RepositoryInterface $repository
     * @param AbstractEntity $entity
     * @param LoggerInterface $logger
     */
    public function __construct(RepositoryInterface $repository, AbstractEntity $entity, LoggerInterface $logger)
    {
        $this->repository = $repository;
        $this->entity = $entity;
        $this->logger = $logger;
    }

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

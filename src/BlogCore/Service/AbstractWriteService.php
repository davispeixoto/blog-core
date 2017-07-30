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
use Psr\Log\LoggerInterface;

/**
 * Class AbstractSaveService
 * @package DavisPeixoto\BlogCore\Service
 */
abstract class AbstractWriteService
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
     * AbstractWriteService constructor.
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
}

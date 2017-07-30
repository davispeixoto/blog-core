<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 7/30/17
 * Time: 7:21 PM
 */

namespace DavisPeixoto\BlogCore\Service;


use DavisPeixoto\BlogCore\Interfaces\RepositoryInterface;
use DavisPeixoto\BlogCore\Interfaces\ServiceInterface;
use Exception;
use Psr\Log\LoggerInterface;
use stdClass;

/**
 * Class AbstractListService
 * @package DavisPeixoto\BlogCore\Service
 */
abstract class AbstractListService implements ServiceInterface
{
    /**
     * @var RepositoryInterface
     */
    protected $repository;

    /**
     * @var array
     */
    protected $filters;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * AbstractListService constructor.
     * @param RepositoryInterface $repository
     * @param array $filters
     * @param LoggerInterface $logger
     */
    public function __construct(RepositoryInterface $repository, array $filters, LoggerInterface $logger)
    {
        $this->repository = $repository;
        $this->filters = $filters;
        $this->logger = $logger;
    }

    /**
     * @return stdClass[]
     */
    public function run(): array
    {
        try {
            return $this->repository->getList($this->filters);
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
        }

        return [];
    }
}

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
 * Class AbstractGetService
 * @package DavisPeixoto\BlogCore\Service
 */
abstract class AbstractGetService implements ServiceInterface
{
    /**
     * @var RepositoryInterface
     */
    protected $repository;

    /**
     * @var string
     */
    protected $uuid;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * AbstractGetService constructor.
     * @param RepositoryInterface $repository
     * @param string $uuid
     * @param LoggerInterface $logger
     */
    public function __construct(RepositoryInterface $repository, string $uuid, LoggerInterface $logger)
    {
        $this->repository = $repository;
        $this->uuid = $uuid;
        $this->logger = $logger;
    }

    /**
     * @return stdClass|null
     */
    public function run()
    {
        try {
            return $this->repository->get($this->uuid);
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
        }

        return null;
    }
}

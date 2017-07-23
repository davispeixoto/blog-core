<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 7/23/17
 * Time: 3:12 AM
 */

namespace DavisPeixoto\BlogCore\Service;


use DavisPeixoto\BlogCore\Interfaces\ServiceInterface;
use DavisPeixoto\BlogCore\Repository\TrailRepository;
use Psr\Log\LoggerInterface;
use Exception;
use Ramsey\Uuid\UuidInterface;
use stdClass;

/**
 * Class GetTrail
 * @package DavisPeixoto\BlogCore\Service
 */
class GetTrail implements ServiceInterface
{
    /**
     * @var TrailRepository
     */
    private $trailRepository;

    /**
     * @var UuidInterface
     */
    private $uuid;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * GetTrail constructor.
     * @param TrailRepository $trailRepository
     * @param UuidInterface $uuid
     * @param LoggerInterface $logger
     */
    public function __construct(TrailRepository $trailRepository, UuidInterface $uuid, LoggerInterface $logger)
    {
        $this->trailRepository = $trailRepository;
        $this->uuid = $uuid;
        $this->logger = $logger;
    }

    /**
     * @return stdClass|boolean
     */
    public function run()
    {
        try {
            return $this->trailRepository->get($this->uuid);
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
        }

        return false;
    }
}

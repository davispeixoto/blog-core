<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 7/23/17
 * Time: 3:06 AM
 */

namespace DavisPeixoto\BlogCore\Service;


use DavisPeixoto\BlogCore\Interfaces\ServiceInterface;
use DavisPeixoto\BlogCore\Repository\TrailRepository;
use DavisPeixoto\BlogCore\Entity\Trail;
use Exception;
use Psr\Log\LoggerInterface;


/**
 * Class DeleteTrail
 * @package DavisPeixoto\BlogCore\Service
 */
class DeleteTrail implements ServiceInterface
{
    /**
     * @var TrailRepository
     */
    private $trailRepository;

    /**
     * @var Trail
     */
    private $trail;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * DeleteTrail constructor.
     * @param TrailRepository $trailRepository
     * @param Trail $trail
     * @param LoggerInterface $logger
     */
    public function __construct(TrailRepository $trailRepository, Trail $trail, LoggerInterface $logger)
    {
        $this->trailRepository = $trailRepository;
        $this->trail = $trail;
        $this->logger = $logger;
    }

    /**
     * @return boolean
     */
    public function run(): bool
    {
        try {
            return $this->trailRepository->delete($this->trail);
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
        }

        return false;
    }
}

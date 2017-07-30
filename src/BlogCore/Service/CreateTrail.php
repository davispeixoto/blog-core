<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 7/23/17
 * Time: 3:06 AM
 */

namespace DavisPeixoto\BlogCore\Service;


use DavisPeixoto\BlogCore\Interfaces\ServiceInterface;
use DavisPeixoto\BlogCore\Repository\AbstractTrailRepository;
use DavisPeixoto\BlogCore\Entity\Trail;
use Exception;
use Psr\Log\LoggerInterface;
use Ramsey\Uuid\UuidInterface;

/**
 * Class CreateTrail
 * @package DavisPeixoto\BlogCore\Service
 */
class CreateTrail implements ServiceInterface
{
    /**
     * @var AbstractTrailRepository
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
     * CreateTrail constructor.
     * @param AbstractTrailRepository $trailRepository
     * @param Trail $trail
     * @param LoggerInterface $logger
     */
    public function __construct(AbstractTrailRepository $trailRepository, Trail $trail, LoggerInterface $logger)
    {
        $this->trailRepository = $trailRepository;
        $this->trail = $trail;
        $this->logger = $logger;
    }

    /**
     * @return string|null
     */
    public function run()
    {
        try {
            return $this->trailRepository->save($this->trail);
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
        }

        return null;
    }
}

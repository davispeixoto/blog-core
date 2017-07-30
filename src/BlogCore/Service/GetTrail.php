<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 7/23/17
 * Time: 3:12 AM
 */

namespace DavisPeixoto\BlogCore\Service;


use DavisPeixoto\BlogCore\Interfaces\ServiceInterface;
use DavisPeixoto\BlogCore\Repository\AbstractTrailRepository;
use Exception;
use Psr\Log\LoggerInterface;
use stdClass;

/**
 * Class GetTrail
 * @package DavisPeixoto\BlogCore\Service
 */
class GetTrail implements ServiceInterface
{
    /**
     * @var AbstractTrailRepository
     */
    private $trailRepository;

    /**
     * @var string
     */
    private $uuid;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * GetTrail constructor.
     * @param AbstractTrailRepository $trailRepository
     * @param string $uuid
     * @param LoggerInterface $logger
     */
    public function __construct(AbstractTrailRepository $trailRepository, string $uuid, LoggerInterface $logger)
    {
        $this->trailRepository = $trailRepository;
        $this->uuid = $uuid;
        $this->logger = $logger;
    }

    /**
     * @return stdClass|null
     */
    public function run()
    {
        try {
            return $this->trailRepository->get($this->uuid);
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
        }

        return null;
    }
}

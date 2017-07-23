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
use Psr\Log\LoggerInterface;
use Exception;
use stdClass;

/**
 * Class ListTrails
 * @package DavisPeixoto\BlogCore\Service
 */
class ListTrails implements ServiceInterface
{
    /**
     * @var AbstractTrailRepository
     */
    private $trailRepository;

    /**
     * @var array
     */
    private $filters;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * ListTrails constructor.
     * @param AbstractTrailRepository $trailRepository
     * @param array $filters
     * @param LoggerInterface $logger
     */
    public function __construct(AbstractTrailRepository $trailRepository, Array $filters, LoggerInterface $logger)
    {
        $this->trailRepository = $trailRepository;
        $this->filters = $filters;
        $this->logger = $logger;
    }

    /**
     * @return array|stdClass[]
     */
    public function run(): array
    {
        try {
            return $this->trailRepository->getList($this->filters);
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
        }

        return [];
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 7/23/17
 * Time: 3:12 AM
 */

namespace DavisPeixoto\BlogCore\Service;

use DavisPeixoto\BlogCore\Repository\AbstractTrailRepository;
use Psr\Log\LoggerInterface;

/**
 * Class GetTrail
 * @package DavisPeixoto\BlogCore\Service
 */
class GetTrail extends AbstractGetService
{
    /**
     * GetTrail constructor.
     * @param AbstractTrailRepository $repository
     * @param string $uuid
     * @param LoggerInterface $logger
     */
    public function __construct(AbstractTrailRepository $repository, string $uuid, LoggerInterface $logger)
    {
        parent::__construct($repository, $uuid, $logger);
    }
}

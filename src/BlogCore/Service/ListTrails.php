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
 * Class ListTrails
 * @package DavisPeixoto\BlogCore\Service
 */
class ListTrails extends AbstractListService
{
    /**
     * ListTrails constructor.
     * @param AbstractTrailRepository $repository
     * @param array $filters
     * @param LoggerInterface $logger
     */
    public function __construct(AbstractTrailRepository $repository, array $filters, LoggerInterface $logger)
    {
        parent::__construct($repository, $filters, $logger);
    }
}

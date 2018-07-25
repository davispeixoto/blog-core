<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 7/23/17
 * Time: 3:06 AM
 */

namespace DavisPeixoto\BlogCore\Service;

use DavisPeixoto\BlogCore\Entity\Trail;
use DavisPeixoto\BlogCore\Repository\AbstractTrailRepository;
use Psr\Log\LoggerInterface;

/**
 * Class EditTrail
 * @package DavisPeixoto\BlogCore\Service
 */
class EditTrail extends AbstractSaveService
{
    /**
     * EditTrail constructor.
     * @param AbstractTrailRepository $repository
     * @param Trail $entity
     * @param LoggerInterface $logger
     */
    public function __construct(AbstractTrailRepository $repository, Trail $entity, LoggerInterface $logger)
    {
        parent::__construct($repository, $entity, $logger);
    }
}

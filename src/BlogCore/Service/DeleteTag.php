<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 7/23/17
 * Time: 3:06 AM
 */

namespace DavisPeixoto\BlogCore\Service;


use DavisPeixoto\BlogCore\Entity\Tag;
use DavisPeixoto\BlogCore\Repository\AbstractTagRepository;
use Psr\Log\LoggerInterface;


/**
 * Class DeleteTag
 * @package DavisPeixoto\BlogCore\Service
 */
class DeleteTag extends AbstractDeleteService
{
    /**
     * DeleteTag constructor.
     * @param AbstractTagRepository $repository
     * @param Tag $entity
     * @param LoggerInterface $logger
     */
    public function __construct(AbstractTagRepository $repository, Tag $entity, LoggerInterface $logger)
    {
        parent::__construct($repository, $entity, $logger);
    }
}

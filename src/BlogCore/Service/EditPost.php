<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 7/23/17
 * Time: 3:06 AM
 */

namespace DavisPeixoto\BlogCore\Service;

use DavisPeixoto\BlogCore\Entity\Post;
use DavisPeixoto\BlogCore\Repository\AbstractPostRepository;
use Psr\Log\LoggerInterface;

/**
 * Class EditPost
 * @package DavisPeixoto\BlogCore\Service
 */
class EditPost extends AbstractSaveService
{
    /**
     * EditPost constructor.
     * @param AbstractPostRepository $repository
     * @param Post $entity
     * @param LoggerInterface $logger
     */
    public function __construct(AbstractPostRepository $repository, Post $entity, LoggerInterface $logger)
    {
        parent::__construct($repository, $entity, $logger);
    }
}

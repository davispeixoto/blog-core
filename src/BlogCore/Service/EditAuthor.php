<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 7/23/17
 * Time: 3:06 AM
 */

namespace DavisPeixoto\BlogCore\Service;

use DavisPeixoto\BlogCore\Entity\Author;
use DavisPeixoto\BlogCore\Repository\AbstractAuthorRepository;
use Psr\Log\LoggerInterface;

/**
 * Class EditAuthor
 * @package DavisPeixoto\BlogCore\Service
 */
class EditAuthor extends AbstractSaveService
{
    /**
     * EditAuthor constructor.
     * @param AbstractAuthorRepository $repository
     * @param Author $entity
     * @param LoggerInterface $logger
     */
    public function __construct(AbstractAuthorRepository $repository, Author $entity, LoggerInterface $logger)
    {
        parent::__construct($repository, $entity, $logger);
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 7/23/17
 * Time: 3:12 AM
 */

namespace DavisPeixoto\BlogCore\Service;


use DavisPeixoto\BlogCore\Repository\AbstractAuthorRepository;
use Psr\Log\LoggerInterface;

/**
 * Class GetAuthor
 * @package DavisPeixoto\BlogCore\Service
 */
class GetAuthor extends AbstractGetService
{
    /**
     * GetAuthor constructor.
     * @param AbstractAuthorRepository $repository
     * @param string $uuid
     * @param LoggerInterface $logger
     */
    public function __construct(AbstractAuthorRepository $repository, string $uuid, LoggerInterface $logger)
    {
        parent::__construct($repository, $uuid, $logger);
    }
}

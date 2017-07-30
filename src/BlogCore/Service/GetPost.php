<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 7/23/17
 * Time: 3:12 AM
 */

namespace DavisPeixoto\BlogCore\Service;


use DavisPeixoto\BlogCore\Repository\AbstractPostRepository;
use Psr\Log\LoggerInterface;

/**
 * Class GetPost
 * @package DavisPeixoto\BlogCore\Service
 */
class GetPost extends AbstractGetService
{
    /**
     * GetPost constructor.
     * @param AbstractPostRepository $repository
     * @param string $uuid
     * @param LoggerInterface $logger
     */
    public function __construct(AbstractPostRepository $repository, string $uuid, LoggerInterface $logger)
    {
        parent::__construct($repository, $uuid, $logger);
    }
}

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
 * Class ListPosts
 * @package DavisPeixoto\BlogCore\Service
 */
class ListPosts extends AbstractListService
{
    public function __construct(AbstractPostRepository $repository, array $filters, LoggerInterface $logger)
    {
        parent::__construct($repository, $filters, $logger);
    }
}

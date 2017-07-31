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
 * Class ListAuthors
 * @package DavisPeixoto\BlogCore\Service
 */
class ListAuthors extends AbstractListService
{
    public function __construct(AbstractAuthorRepository $repository, array $filters, LoggerInterface $logger)
    {
        parent::__construct($repository, $filters, $logger);
    }
}

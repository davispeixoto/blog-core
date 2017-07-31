<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 7/23/17
 * Time: 3:12 AM
 */

namespace DavisPeixoto\BlogCore\Service;


use DavisPeixoto\BlogCore\Repository\AbstractTagRepository;
use Psr\Log\LoggerInterface;

/**
 * Class ListTags
 * @package DavisPeixoto\BlogCore\Service
 */
class ListTags extends AbstractListService
{
    /**
     * ListTags constructor.
     * @param AbstractTagRepository $repository
     * @param array $filters
     * @param LoggerInterface $logger
     */
    public function __construct(AbstractTagRepository $repository, array $filters, LoggerInterface $logger)
    {
        parent::__construct($repository, $filters, $logger);
    }
}

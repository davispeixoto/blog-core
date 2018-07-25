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
 * Class GetTag
 * @package DavisPeixoto\BlogCore\Service
 */
class GetTag extends AbstractGetService
{
    /**
     * GetTag constructor.
     * @param AbstractTagRepository $repository
     * @param string $uuid
     * @param LoggerInterface $logger
     */
    public function __construct(AbstractTagRepository $repository, string $uuid, LoggerInterface $logger)
    {
        parent::__construct($repository, $uuid, $logger);
    }
}

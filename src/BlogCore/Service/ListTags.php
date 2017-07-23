<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 7/23/17
 * Time: 3:12 AM
 */

namespace DavisPeixoto\BlogCore\Service;


use DavisPeixoto\BlogCore\Interfaces\ServiceInterface;
use DavisPeixoto\BlogCore\Repository\AbstractTagRepository;
use Psr\Log\LoggerInterface;
use Exception;
use stdClass;

/**
 * Class ListTags
 * @package DavisPeixoto\BlogCore\Service
 */
class ListTags implements ServiceInterface
{
    /**
     * @var AbstractTagRepository
     */
    private $tagRepository;

    /**
     * @var array
     */
    private $filters;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * ListTags constructor.
     * @param AbstractTagRepository $tagRepository
     * @param array $filters
     * @param LoggerInterface $logger
     */
    public function __construct(AbstractTagRepository $tagRepository, Array $filters, LoggerInterface $logger)
    {
        $this->tagRepository = $tagRepository;
        $this->filters = $filters;
        $this->logger = $logger;
    }

    /**
     * @return array|stdClass[]
     */
    public function run(): array
    {
        try {
            return $this->tagRepository->getList($this->filters);
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
        }

        return [];
    }
}

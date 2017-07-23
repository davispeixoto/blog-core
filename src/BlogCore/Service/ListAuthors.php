<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 7/23/17
 * Time: 3:12 AM
 */

namespace DavisPeixoto\BlogCore\Service;


use DavisPeixoto\BlogCore\Interfaces\ServiceInterface;
use DavisPeixoto\BlogCore\Repository\AbstractAuthorRepository;
use Psr\Log\LoggerInterface;
use Exception;
use stdClass;

/**
 * Class ListAuthors
 * @package DavisPeixoto\BlogCore\Service
 */
class ListAuthors implements ServiceInterface
{
    /**
     * @var AbstractAuthorRepository
     */
    private $authorRepository;

    /**
     * @var array
     */
    private $filters;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * ListAuthors constructor.
     * @param AbstractAuthorRepository $authorRepository
     * @param array $filters
     * @param LoggerInterface $logger
     */
    public function __construct(AbstractAuthorRepository $authorRepository, Array $filters, LoggerInterface $logger)
    {
        $this->authorRepository = $authorRepository;
        $this->filters = $filters;
        $this->logger = $logger;
    }

    /**
     * @return array|stdClass[]
     */
    public function run(): array
    {
        try {
            return $this->authorRepository->getList($this->filters);
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
        }

        return [];
    }
}

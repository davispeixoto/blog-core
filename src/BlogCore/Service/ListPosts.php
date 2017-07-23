<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 7/23/17
 * Time: 3:12 AM
 */

namespace DavisPeixoto\BlogCore\Service;


use DavisPeixoto\BlogCore\Interfaces\ServiceInterface;
use DavisPeixoto\BlogCore\Repository\PostRepository;
use Psr\Log\LoggerInterface;
use Exception;
use stdClass;

/**
 * Class ListPosts
 * @package DavisPeixoto\BlogCore\Service
 */
class ListPosts implements ServiceInterface
{
    /**
     * @var PostRepository
     */
    private $postRepository;

    /**
     * @var array
     */
    private $filters;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * ListPosts constructor.
     * @param PostRepository $postRepository
     * @param array $filters
     * @param LoggerInterface $logger
     */
    public function __construct(PostRepository $postRepository, Array $filters, LoggerInterface $logger)
    {
        $this->postRepository = $postRepository;
        $this->filters = $filters;
        $this->logger = $logger;
    }

    /**
     * @return array|stdClass[]
     */
    public function run(): array
    {
        try {
            return $this->postRepository->getList($this->filters);
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
        }

        return [];
    }
}

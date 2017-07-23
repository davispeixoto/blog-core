<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 7/23/17
 * Time: 3:06 AM
 */

namespace DavisPeixoto\BlogCore\Service;


use DavisPeixoto\BlogCore\Interfaces\ServiceInterface;
use DavisPeixoto\BlogCore\Repository\AbstractPostRepository;
use DavisPeixoto\BlogCore\Entity\Post;
use Exception;
use Psr\Log\LoggerInterface;


/**
 * Class DeletePost
 * @package DavisPeixoto\BlogCore\Service
 */
class DeletePost implements ServiceInterface
{
    /**
     * @var AbstractPostRepository
     */
    private $postRepository;

    /**
     * @var Post
     */
    private $post;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * DeletePost constructor.
     * @param AbstractPostRepository $postRepository
     * @param Post $post
     * @param LoggerInterface $logger
     */
    public function __construct(AbstractPostRepository $postRepository, Post $post, LoggerInterface $logger)
    {
        $this->postRepository = $postRepository;
        $this->post = $post;
        $this->logger = $logger;
    }

    /**
     * @return boolean
     */
    public function run(): bool
    {
        try {
            return $this->postRepository->delete($this->post);
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
        }

        return false;
    }
}

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
use Ramsey\Uuid\UuidInterface;

/**
 * Class EditPost
 * @package DavisPeixoto\BlogCore\Service
 */
class EditPost implements ServiceInterface
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
     * EditPost constructor.
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
     * @return string|null
     */
    public function run()
    {
        try {
            return $this->postRepository->save($this->post);
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
        }

        return null;
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 7/23/17
 * Time: 3:12 AM
 */

namespace DavisPeixoto\BlogCore\Service;


use DavisPeixoto\BlogCore\Interfaces\ServiceInterface;
use DavisPeixoto\BlogCore\Repository\AbstractPostRepository;
use Exception;
use Psr\Log\LoggerInterface;
use stdClass;

/**
 * Class GetPost
 * @package DavisPeixoto\BlogCore\Service
 */
class GetPost implements ServiceInterface
{
    /**
     * @var AbstractPostRepository
     */
    private $postRepository;

    /**
     * @var string
     */
    private $uuid;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * GetPost constructor.
     * @param AbstractPostRepository $postRepository
     * @param string $uuid
     * @param LoggerInterface $logger
     */
    public function __construct(AbstractPostRepository $postRepository, string $uuid, LoggerInterface $logger)
    {
        $this->postRepository = $postRepository;
        $this->uuid = $uuid;
        $this->logger = $logger;
    }

    /**
     * @return stdClass|null
     */
    public function run()
    {
        try {
            return $this->postRepository->get($this->uuid);
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
        }

        return null;
    }
}

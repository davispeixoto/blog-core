<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 7/23/17
 * Time: 3:12 AM
 */

namespace DavisPeixoto\BlogCore\Service;


use DavisPeixoto\BlogCore\Interfaces\ServiceInterface;
use DavisPeixoto\BlogCore\Repository\TagRepository;
use Psr\Log\LoggerInterface;
use Exception;
use Ramsey\Uuid\UuidInterface;
use stdClass;

/**
 * Class GetTag
 * @package DavisPeixoto\BlogCore\Service
 */
class GetTag implements ServiceInterface
{
    /**
     * @var TagRepository
     */
    private $tagRepository;

    /**
     * @var UuidInterface
     */
    private $uuid;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * GetTag constructor.
     * @param TagRepository $tagRepository
     * @param UuidInterface $uuid
     * @param LoggerInterface $logger
     */
    public function __construct(TagRepository $tagRepository, UuidInterface $uuid, LoggerInterface $logger)
    {
        $this->tagRepository = $tagRepository;
        $this->uuid = $uuid;
        $this->logger = $logger;
    }

    /**
     * @return stdClass|false
     */
    public function run()
    {
        try {
            return $this->tagRepository->get($this->uuid);
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
        }

        return false;
    }
}

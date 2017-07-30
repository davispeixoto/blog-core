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
use Exception;
use Psr\Log\LoggerInterface;
use stdClass;

/**
 * Class GetTag
 * @package DavisPeixoto\BlogCore\Service
 */
class GetTag implements ServiceInterface
{
    /**
     * @var AbstractTagRepository
     */
    private $tagRepository;

    /**
     * @var string
     */
    private $uuid;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * GetTag constructor.
     * @param AbstractTagRepository $tagRepository
     * @param string $uuid
     * @param LoggerInterface $logger
     */
    public function __construct(AbstractTagRepository $tagRepository, string $uuid, LoggerInterface $logger)
    {
        $this->tagRepository = $tagRepository;
        $this->uuid = $uuid;
        $this->logger = $logger;
    }

    /**
     * @return stdClass|null
     */
    public function run()
    {
        try {
            return $this->tagRepository->get($this->uuid);
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
        }

        return null;
    }
}

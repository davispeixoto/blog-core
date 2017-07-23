<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 7/23/17
 * Time: 3:06 AM
 */

namespace DavisPeixoto\BlogCore\Service;


use DavisPeixoto\BlogCore\Entity\Tag;
use DavisPeixoto\BlogCore\Interfaces\ServiceInterface;
use DavisPeixoto\BlogCore\Repository\TagRepository;
use Exception;
use Psr\Log\LoggerInterface;


/**
 * Class DeleteTag
 * @package DavisPeixoto\BlogCore\Service
 */
class DeleteTag implements ServiceInterface
{
    /**
     * @var TagRepository
     */
    private $tagRepository;

    /**
     * @var Tag
     */
    private $tag;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * DeleteTag constructor.
     * @param TagRepository $tagRepository
     * @param Tag $tag
     * @param LoggerInterface $logger
     */
    public function __construct(TagRepository $tagRepository, Tag $tag, LoggerInterface $logger)
    {
        $this->tagRepository = $tagRepository;
        $this->tag = $tag;
        $this->logger = $logger;
    }

    /**
     * @return boolean
     */
    public function run(): bool
    {
        try {
            return $this->tagRepository->delete($this->tag);
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
        }

        return false;
    }
}

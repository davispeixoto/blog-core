<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 7/23/17
 * Time: 3:12 AM
 */

namespace DavisPeixoto\BlogCore\Service;


use DavisPeixoto\BlogCore\Interfaces\ServiceInterface;
use DavisPeixoto\BlogCore\Repository\AuthorRepository;
use Psr\Log\LoggerInterface;
use Exception;
use Ramsey\Uuid\UuidInterface;
use stdClass;

/**
 * Class GetAuthor
 * @package DavisPeixoto\BlogCore\Service
 */
class GetAuthor implements ServiceInterface
{
    /**
     * @var AuthorRepository
     */
    private $authorRepository;

    /**
     * @var UuidInterface
     */
    private $uuid;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * GetAuthor constructor.
     * @param AuthorRepository $authorRepository
     * @param UuidInterface $uuid
     * @param LoggerInterface $logger
     */
    public function __construct(AuthorRepository $authorRepository, UuidInterface $uuid, LoggerInterface $logger)
    {
        $this->authorRepository = $authorRepository;
        $this->uuid = $uuid;
        $this->logger = $logger;
    }

    /**
     * @return stdClass|boolean
     */
    public function run()
    {
        try {
            return $this->authorRepository->get($this->uuid);
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
        }

        return false;
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 7/23/17
 * Time: 3:06 AM
 */

namespace DavisPeixoto\BlogCore\Service;


use DavisPeixoto\BlogCore\Interfaces\ServiceInterface;
use DavisPeixoto\BlogCore\Repository\AuthorRepository;
use DavisPeixoto\BlogCore\Entity\Author;
use Exception;
use Psr\Log\LoggerInterface;
use Ramsey\Uuid\UuidInterface;

/**
 * Class CreateAuthor
 * @package DavisPeixoto\BlogCore\Service
 */
class CreateAuthor implements ServiceInterface
{
    /**
     * @var AuthorRepository
     */
    private $authorRepository;

    /**
     * @var Author
     */
    private $author;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * CreateAuthor constructor.
     * @param AuthorRepository $authorRepository
     * @param Author $author
     * @param LoggerInterface $logger
     */
    public function __construct(AuthorRepository $authorRepository, Author $author, LoggerInterface $logger)
    {
        $this->authorRepository = $authorRepository;
        $this->author = $author;
        $this->logger = $logger;
    }

    /**
     * @return UuidInterface|null
     */
    public function run()
    {
        try {
            return $this->authorRepository->save($this->author);
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
        }

        return null;
    }
}

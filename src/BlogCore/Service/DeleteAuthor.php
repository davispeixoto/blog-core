<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 7/23/17
 * Time: 3:06 AM
 */

namespace DavisPeixoto\BlogCore\Service;


use DavisPeixoto\BlogCore\Interfaces\ServiceInterface;
use DavisPeixoto\BlogCore\Repository\AbstractAuthorRepository;
use DavisPeixoto\BlogCore\Entity\Author;
use Exception;
use Psr\Log\LoggerInterface;


/**
 * Class DeleteAuthor
 * @package DavisPeixoto\BlogCore\Service
 */
class DeleteAuthor implements ServiceInterface
{
    /**
     * @var AbstractAuthorRepository
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
     * DeleteAuthor constructor.
     * @param AbstractAuthorRepository $authorRepository
     * @param Author $author
     * @param LoggerInterface $logger
     */
    public function __construct(AbstractAuthorRepository $authorRepository, Author $author, LoggerInterface $logger)
    {
        $this->authorRepository = $authorRepository;
        $this->author = $author;
        $this->logger = $logger;
    }

    /**
     * @return boolean
     */
    public function run(): bool
    {
        try {
            return $this->authorRepository->delete($this->author);
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
        }

        return false;
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 7/23/17
 * Time: 3:12 AM
 */

namespace DavisPeixoto\BlogCore\Service;


use DavisPeixoto\BlogCore\Interfaces\ServiceInterface;
use DavisPeixoto\BlogCore\Repository\AbstractAuthorRepository;
use Exception;
use Psr\Log\LoggerInterface;
use stdClass;

/**
 * Class GetAuthor
 * @package DavisPeixoto\BlogCore\Service
 */
class GetAuthor implements ServiceInterface
{
    /**
     * @var AbstractAuthorRepository
     */
    private $authorRepository;

    /**
     * @var string
     */
    private $uuid;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * GetAuthor constructor.
     * @param AbstractAuthorRepository $authorRepository
     * @param string $uuid
     * @param LoggerInterface $logger
     */
    public function __construct(
        AbstractAuthorRepository $authorRepository,
        string $uuid,
        LoggerInterface $logger
    ) {
        $this->uuid = $uuid;
        $this->logger = $logger;
        $this->authorRepository = $authorRepository;
    }

    /**
     * @return stdClass|null
     */
    public function run()
    {
        try {
            return $this->authorRepository->get($this->uuid);
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
        }

        return null;
    }
}

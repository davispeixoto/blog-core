<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 7/23/17
 * Time: 3:05 AM
 */

namespace DavisPeixoto\BlogCore\Entity;


use DateTime;
use Ramsey\Uuid\UuidInterface;
use stdClass;

/**
 * Class Author
 * @package DavisPeixoto\BlogCore\Entity
 */
class Author extends stdClass
{
    /**
     * @var UuidInterface
     */
    private $authorId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $bio;

    /**
     * @var DateTime|null
     */
    private $birthdate;

    /**
     * Author constructor.
     * @param UuidInterface $authorId
     * @param string $name
     * @param string $email
     * @param string $bio
     * @param DateTime|null $birthdate
     */
    public function __construct(UuidInterface $authorId, $name, $email, $bio, DateTime $birthdate = null)
    {
        $this->authorId = $authorId;
        $this->name = $name;
        $this->email = $email;
        $this->bio = $bio;
        $this->birthdate = $birthdate;
    }

    /**
     * @codeCoverageIgnore
     * @return UuidInterface
     */
    public function getAuthorId(): UuidInterface
    {
        return $this->authorId;
    }

    /**
     * @codeCoverageIgnore
     * @param UuidInterface $authorId
     */
    public function setAuthorId(UuidInterface $authorId)
    {
        $this->authorId = $authorId;
    }

    /**
     * @codeCoverageIgnore
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @codeCoverageIgnore
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @codeCoverageIgnore
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        if ($email !== false) {
            $this->email = $email;
        }
    }

    /**
     * @codeCoverageIgnore
     * @return string
     */
    public function getBio(): string
    {
        return $this->bio;
    }

    /**
     * @codeCoverageIgnore
     * @param string $bio
     */
    public function setBio(string $bio)
    {
        $this->bio = $bio;
    }

    /**
     * @codeCoverageIgnore
     * @return DateTime|null
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * @codeCoverageIgnore
     * @param DateTime|null $birthdate
     */
    public function setBirthdate(DateTime $birthdate = null)
    {
        $this->birthdate = $birthdate;
    }
}

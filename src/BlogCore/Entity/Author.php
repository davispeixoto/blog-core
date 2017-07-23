<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 7/23/17
 * Time: 3:05 AM
 */

namespace DavisPeixoto\Entity;


use DateTime;
use Ramsey\Uuid\Uuid;

class Author
{
    /**
     * @var Uuid
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
     * @var DateTime
     */
    private $birthdate;

    /**
     * Author constructor.
     * @param Uuid $authorId
     * @param string $name
     * @param string $email
     * @param string $bio
     * @param DateTime $birthdate
     */
    public function __construct(Uuid $authorId, $name, $email, $bio, DateTime $birthdate = null)
    {
        $this->authorId = $authorId;
        $this->name = $name;
        $this->email = $email;
        $this->bio = $bio;
        $this->birthdate = $birthdate;
    }

    /**
     * @return Uuid
     */
    public function getAuthorId(): Uuid
    {
        return $this->authorId;
    }

    /**
     * @param Uuid $authorId
     */
    public function setAuthorId(Uuid $authorId)
    {
        $this->authorId = $authorId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
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
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getBio(): string
    {
        return $this->bio;
    }

    /**
     * @param string $bio
     */
    public function setBio(string $bio)
    {
        $this->bio = $bio;
    }

    /**
     * @return DateTime
     */
    public function getBirthdate(): DateTime
    {
        return $this->birthdate;
    }

    /**
     * @param DateTime $birthdate
     */
    public function setBirthdate(DateTime $birthdate)
    {
        $this->birthdate = $birthdate;
    }
}

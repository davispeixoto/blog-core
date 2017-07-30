<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 7/23/17
 * Time: 3:05 AM
 */

namespace DavisPeixoto\BlogCore\Entity;


use DateTime;

/**
 * Class Author
 * @package DavisPeixoto\BlogCore\Entity
 */
class Author extends AbstractEntity
{
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
     * @param string $name
     * @param string $email
     * @param string $bio
     * @param string|null $id
     * @param DateTime|null $birthdate
     */
    public function __construct($name, $email, $bio, $id = null, DateTime $birthdate = null)
    {
        $this->setId($id);
        $this->setName($name);
        $this->setEmail($email);
        $this->setBio($bio);
        $this->setBirthdate($birthdate);
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

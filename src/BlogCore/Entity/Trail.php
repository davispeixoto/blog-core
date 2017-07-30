<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 7/23/17
 * Time: 3:04 AM
 */

namespace DavisPeixoto\BlogCore\Entity;

use Ramsey\Uuid\Exception\InvalidUuidStringException;

/**
 * Class Trail
 * @package DavisPeixoto\BlogCore\Entity
 */
class Trail extends AbstractEntity
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var array|Post[]
     */
    private $posts;

    /**
     * Trail constructor.
     * @param string $name
     * @param string $description
     * @param string|null $id
     * @param Post[] $posts
     * @throws InvalidUuidStringException
     */
    public function __construct($name, $description, string $id = null, array $posts = [])
    {
        $this->setId($id);
        $this->setName($name);
        $this->setDescription($description);
        $this->setPosts($posts);
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
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @codeCoverageIgnore
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * @return Post[]
     */
    public function getPosts(): array
    {
        return $this->posts;
    }

    /**
     * @param Post[] $posts
     */
    public function setPosts($posts)
    {
        $this->posts = array_unique($posts, SORT_REGULAR);
    }

    /**
     * @param Post $post
     * @return $this
     */
    public function addPost(Post $post)
    {
        $posts = $this->getPosts();
        $posts[] = $post;
        $this->setPosts($posts);

        return $this;
    }

    /**
     * @param Post $post
     * @return $this
     */
    public function removePost(Post $post)
    {
        foreach ($this->getPosts() as $key => $value) {
            if ($value->getId() === $post->getId()) {
                unset($this->posts[$key]);
                sort($this->posts);

                return $this;
            }
        }

        return $this;
    }
}

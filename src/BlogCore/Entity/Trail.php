<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 7/23/17
 * Time: 3:04 AM
 */

namespace DavisPeixoto\Entity;


use Ramsey\Uuid\UuidInterface;
use stdClass;

/**
 * Class Trail
 * @package DavisPeixoto\Entity
 */
class Trail extends stdClass
{
    /**
     * @var UuidInterface
     */
    private $trailId;

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
     * @param UuidInterface $trailId
     * @param string $name
     * @param string $description
     * @param Post[] $posts
     */
    public function __construct(UuidInterface $trailId, $name, $description, array $posts = [])
    {
        $this->trailId = $trailId;
        $this->name = $name;
        $this->description = $description;
        $this->posts = $posts;
    }

    /**
     * @codeCoverageIgnore
     * @return UuidInterface
     */
    public function getTrailId(): UuidInterface
    {
        return $this->trailId;
    }

    /**
     * @codeCoverageIgnore
     * @param UuidInterface $trailId
     */
    public function setTrailId(UuidInterface $trailId)
    {
        $this->trailId = $trailId;
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
     * @codeCoverageIgnore
     * @return Post[]
     */
    public function getPosts(): array
    {
        return $this->posts;
    }

    /**
     * @codeCoverageIgnore
     * @param Post[] $posts
     */
    public function setPosts($posts)
    {
        $this->posts = array_unique($posts);
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
            if ($value->getPostId() === $post->getPostId()) {
                unset($this->posts[$key]);

                return $this;
            }
        }

        return $this;
    }
}

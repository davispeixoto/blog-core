<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 7/23/17
 * Time: 3:04 AM
 */

namespace DavisPeixoto\Entity;


use Ramsey\Uuid\Uuid;
use stdClass;

class Trail extends stdClass
{
    /**
     * @var Uuid
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
     * @param Uuid $trailId
     * @param string $name
     * @param string $description
     * @param Post[] $posts
     */
    public function __construct(Uuid $trailId, $name, $description, array $posts = [])
    {
        $this->trailId = $trailId;
        $this->name = $name;
        $this->description = $description;
        $this->posts = $posts;
    }

    /**
     * @return Uuid
     */
    public function getTrailId(): Uuid
    {
        return $this->trailId;
    }

    /**
     * @param Uuid $trailId
     */
    public function setTrailId(Uuid $trailId)
    {
        $this->trailId = $trailId;
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
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
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

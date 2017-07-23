<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 7/23/17
 * Time: 3:04 AM
 */

namespace DavisPeixoto\Entity;


use Ramsey\Uuid\Uuid;

class Trail
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
    public function __construct(Uuid $trailId, $name, $description, $posts = [])
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
     * @return array|Post[]
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * @param Post[] $posts
     */
    public function setPosts($posts)
    {
        $this->posts = $posts;
    }

    /**
     * @param Post $post
     * @return $this
     */
    public function addPost(Post $post)
    {
        $this->posts[] = $post;

        return $this;
    }

    /**
     * @param Uuid $postId
     * @return $this
     */
    public function removePost(Uuid $postId)
    {
        foreach ($this->posts as $key => $post) {
            if ($post->postId === $postId) {
                unset($this->posts[$key]);

                return $this;
            }
        }

        return $this;
    }
}

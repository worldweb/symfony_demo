<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostMetaRepository")
 */
class PostMeta
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Post", inversedBy="postMetas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $post_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $meta_key;

    /**
     * @ORM\Column(type="text")
     */
    private $meta_value;

    public function getId()
    {
        return $this->id;
    }

    public function getPostId(): ?Post
    {
        return $this->post_id;
    }

    public function setPostId(?Post $post_id): self
    {
        $this->post_id = $post_id;

        return $this;
    }

    public function getMetaKey(): ?string
    {
        return $this->meta_key;
    }

    public function setMetaKey(string $meta_key): self
    {
        $this->meta_key = $meta_key;

        return $this;
    }

    public function getMetaValue(): ?string
    {
        return $this->meta_value;
    }

    public function setMetaValue(string $meta_value): self
    {
        $this->meta_value = $meta_value;

        return $this;
    }
}

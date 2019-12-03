<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use JsonSerializable;

/**
 * Topic
 *
 * @ORM\Table(name="topic", uniqueConstraints={@ORM\UniqueConstraint(name="topic_title_key", columns={"title"}), @ORM\UniqueConstraint(name="topic_slug_key", columns={"slug"})})
 * @ORM\Entity(repositoryClass="App\Repository\TopicRepository")
 */
class Topic implements JsonSerializable
{
    public function jsonSerialize()
    {
        // TODO: Implement jsonSerialize() method.

        return $this->getId();
    }

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="topic_id_seq", allocationSize=1, initialValue=1)
     *  @Groups({"read"})
     */
    private $id;

    /**
     * @ORM\Column(name="title", type="string", length=122, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return \DateTime|null
     */
    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime|null $createdAt
     */
    public function setCreatedAt(?\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return string|null
     */
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    /**
     * @param string|null $slug
     */
    public function setSlug(?string $slug): void
    {
        $this->slug = $slug;
    }

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_at", type="date", nullable=true, options={"default"="CURRENT_DATE"})
     */
    private $createdAt = 'CURRENT_DATE';

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @var string|null
     *
     * @ORM\Column(name="slug", type="string", length=128, nullable=true)
     */
    private $slug;


    /**
     * @var
     * @ORM\OneToMany(targetEntity="App\Entity\Post", mappedBy="topic")
     */
    private $posts;

    /**
     * @return Collection/Post
     */
    public function getPosts() : Collection
    {
        return $this->posts;
    }

    public function __construct()
    {
        $this->posts =  new ArrayCollection();
    }

    public function addPost(Post $post): self
    {
        if (!$this->posts->contains($post)) {
            $this->posts[] = $post;
            $post->setTopic($this);
        }

        return $this;
    }

    public function removePost(Post $post): self
    {
        if ($this->posts->contains($post)) {
            $this->posts->removeElement($post);
            // set the owning side to null (unless already changed)
            if ($post->getTopic() === $this) {
                $post->setTopic(null);
            }
        }
        return $this;
    }

    public function __toString()
    {
        return $this->getTitle();
    }
}
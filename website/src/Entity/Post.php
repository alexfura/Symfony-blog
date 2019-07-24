<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use JsonSerializable;

/**
 * Post
 *
 * @ORM\Table(name="post", uniqueConstraints={@ORM\UniqueConstraint(name="uq_post_id", columns={"id"}), @ORM\UniqueConstraint(name="post_title_key", columns={"title"})}, indexes={@ORM\Index(name="IDX_5A8A6C8D1F55203D", columns={"topic_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 */
class Post implements JsonSerializable
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="post_id_seq", allocationSize=1, initialValue=1)
     * @Groups({"read"})
     */
    private $id;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=122, nullable=false)
     * @Groups({"read"})
     */
    private $title;

    /**
     * @var string|null
     *
     * @ORM\Column(name="text_field", type="text", nullable=true)
     *  @Groups({"read"})
     */
    private $textField;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_at", type="date", nullable=true, options={"default"="CURRENT_DATE"})
     *  @Groups({"read"})

     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Topic", inversedBy="posts")
     *  @Groups({"read"})
     */
    private $topic;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="posts")
     * @Groups({"read"})
     */
    private $author;

    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTextField(): ?string
    {
        return $this->textField;
    }

    /**
     * @param string|null $textField
     */
    public function setTextField(?string $textField): void
    {
        $this->textField = $textField;
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
     * @return \Topic
     */
    public function getTopic(): ?Topic
    {
        return $this->topic;
    }

    /**
     * @param Topic $topic
     */
    public function setTopic(Topic $topic): void
    {
        $this->topic = $topic;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'title' => $this->title,
            'textField' => $this->textField,
            'topic' => $this->getTopic(),
            'author' => $this->getAuthor()
        ];
    }
}

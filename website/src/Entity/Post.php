<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Post
 *
 * @ORM\Table(name="post", uniqueConstraints={@ORM\UniqueConstraint(name="uq_post_id", columns={"id"}), @ORM\UniqueConstraint(name="post_title_key", columns={"title"})}, indexes={@ORM\Index(name="IDX_5A8A6C8D1F55203D", columns={"topic_id"})})
 * @ORM\Entity
 */
class Post
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="post_id_seq", allocationSize=1, initialValue=1)
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
     */
    private $title;

    /**
     * @var string|null
     *
     * @ORM\Column(name="text_field", type="text", nullable=true)
     */
    private $textField;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_at", type="date", nullable=true, options={"default"="CURRENT_DATE"})
     */
    private $createdAt = 'CURRENT_DATE';

    /**
     * @var string|null
     *
     * @ORM\Column(name="author", type="string", length=122, nullable=true)
     */
    private $author;

    /**
     * @var \Topic
     *
     * @ORM\ManyToOne(targetEntity="Topic")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="topic_id", referencedColumnName="id")
     * })
     */
    private $topic;

    /**
     * @return string
     */
    public function getTitle(): string
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
     * @return string|null
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
     * @return string|null
     */
    public function getAuthor(): ?string
    {
        return $this->author;
    }

    /**
     * @param string|null $author
     */
    public function setAuthor(?string $author): void
    {
        $this->author = $author;
    }

    /**
     * @return \Topic
     */
    public function getTopic(): \Topic
    {
        return $this->topic;
    }

    /**
     * @param \Topic $topic
     */
    public function setTopic(\Topic $topic): void
    {
        $this->topic = $topic;
    }


}

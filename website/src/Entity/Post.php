<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Post
 *
 * @ORM\Table(name="post", uniqueConstraints={@ORM\UniqueConstraint(name="post_title_key", columns={"title"})})
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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=122, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="text_field", type="text", nullable=true)
     */
    private $textField;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="creation_date", type="date", nullable=true, options={"default"="CURRENT_DATE"})
     */
    private $creationDate = 'CURRENT_DATE';

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

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
     * @param string $textField
     */
    public function setTextField(?string $textField): void
    {
        $this->textField = $textField;
    }

    /**
     * @return \DateTime|null
     */
    public function getCreationDate(): ?\DateTime
    {
        return $this->creationDate;
    }

    /**
     * @param \DateTime|null $creationDate
     */
    public function setCreationDate(?\DateTime $creationDate): void
    {
        $this->creationDate = $creationDate;
    }

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * @param string $author
     */
    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=122, nullable=false, options={"default"="anonymus"})
     */
    private $author = 'anonymus';


}

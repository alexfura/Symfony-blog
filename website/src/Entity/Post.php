<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Post
 *
 * @ORM\Table(name="post", uniqueConstraints={@ORM\UniqueConstraint(name="post_title_key", columns={"title"})}, indexes={@ORM\Index(name="IDX_5A8A6C8D1F55203D", columns={"topic_id"})})
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


}

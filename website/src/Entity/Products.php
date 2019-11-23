<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Products
 *
 * @ORM\Table(name="products", indexes={@ORM\Index(name="IDX_B3BA5A5ACDFC7356", columns={"product_category"}), @ORM\Index(name="IDX_B3BA5A5ABD0E8204", columns={"product_brand"})})
 * @ORM\Entity
 */
class Products
{
    /**
     * @var int
     *
     * @ORM\Column(name="product_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="products_product_id_seq", allocationSize=1, initialValue=1)
     */
    private $productId;

    /**
     * @var string
     *
     * @ORM\Column(name="product_name", type="string", length=255, nullable=false)
     */
    private $productName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="product_man_date", type="date", nullable=false, options={"default"="CURRENT_DATE"})
     */
    private $productManDate = 'CURRENT_DATE';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="product_exp_date", type="date", nullable=true)
     */
    private $productExpDate;

    /**
     * @var \Categories
     *
     * @ORM\ManyToOne(targetEntity="Categories")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_category", referencedColumnName="category_id")
     * })
     */
    private $productCategory;

    /**
     * @var \Brands
     *
     * @ORM\ManyToOne(targetEntity="Brands")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_brand", referencedColumnName="brand_id")
     * })
     */
    private $productBrand;


}

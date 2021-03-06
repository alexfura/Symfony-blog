<?php

namespace App\Entity;

use DateTime;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
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
     * @ORM\Column(name="product_man_date", type="date", nullable=false, options={"default"="CURRENT_DATE"})
     */
    private $productManDate;

    /**
     * @var DateTime|null
     *
     * @ORM\Column(name="product_exp_date", type="date", nullable=true)
     */
    private $productExpDate;

    /**
     * @var Categories|null
     *
     * @ORM\ManyToOne(targetEntity="Categories", inversedBy="products")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_category", referencedColumnName="category_id", onDelete="SET NULL")
     * })
     */
    private $productCategory;

    /**
     * @var Brands|null
     *
     * @ORM\ManyToOne(targetEntity="Brands", inversedBy="products")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_brand", referencedColumnName="brand_id", onDelete="SET NULL")
     * })
     */
    private $productBrand;


    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Supplies", mappedBy="supplyProduct")
     */
    private $productSupplies;

    public function __construct()
    {
        $this->productSupplies = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getProductSupplies()
    {
        return $this->productSupplies;
    }

    /**
     * @param mixed $productSupplies
     */
    public function setProductSupplies($productSupplies): void
    {
        $this->productSupplies = $productSupplies;
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->productId;
    }

    /**
     * @param int $productId
     */
    public function setProductId(int $productId): void
    {
        $this->productId = $productId;
    }

    /**
     * @return string|null
     */
    public function getProductName(): ?string
    {
        return $this->productName;
    }

    /**
     * @param string $productName
     */
    public function setProductName(string $productName): void
    {
        $this->productName = $productName;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getProductManDate(): ?DateTimeInterface
    {
        return $this->productManDate;
    }

    public function setProductManDate($productManDate): void
    {
        $this->productManDate = $productManDate;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getProductExpDate(): ?DateTimeInterface
    {
        return $this->productExpDate;
    }

    /**
     * @param DateTime|null $productExpDate
     */
    public function setProductExpDate(?DateTime $productExpDate): void
    {
        $this->productExpDate = $productExpDate;
    }

    /**
     * @return Categories|null
     */
    public function getProductCategory(): ?Categories
    {
        return $this->productCategory;
    }

    /**
     * @param Categories|null $productCategory
     */
    public function setProductCategory(?Categories $productCategory): void
    {
        $this->productCategory = $productCategory;
    }

    /**
     * @return Brands|null
     */
    public function getProductBrand(): ?Brands
    {
        return $this->productBrand;
    }

    /**
     * @param Brands|null $productBrand
     */
    public function setProductBrand(?Brands $productBrand): void
    {
        $this->productBrand = $productBrand;
    }

}

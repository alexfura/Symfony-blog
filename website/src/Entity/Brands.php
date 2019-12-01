<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;

/**
 * Brands
 *
 * @ORM\Table(name="brands", uniqueConstraints={@ORM\UniqueConstraint(name="brands_brand_name_key", columns={"brand_name"})})
 * @ORM\Entity
 */
class Brands
{
    /**
     * @var int
     *
     * @ORM\Column(name="brand_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="brands_brand_id_seq", allocationSize=1, initialValue=1)
     */
    private $brandId;

    /**
     * @var string
     *
     * @ORM\Column(name="brand_name", type="string", length=225, nullable=false)
     */
    private $brandName;


    /**
     * @var
     * @ORM\OneToMany(targetEntity="Products", mappedBy="ProductBrand")
     */
    private $products;


    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getBrandId(): int
    {
        return $this->brandId;
    }

    /**
     * @param int $brandId
     */
    public function setBrandId(int $brandId): void
    {
        $this->brandId = $brandId;
    }

    /**
     * @return string
     */
    public function getBrandName(): ?string
    {
        return $this->brandName;
    }

    /**
     * @param string $brandName
     */
    public function setBrandName(string $brandName): void
    {
        $this->brandName = $brandName;
    }

    /**
     * @return mixed
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param mixed $products
     */
    public function setProducts($products): void
    {
        $this->products = $products;
    }
}

<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Supplies
 *
 * @ORM\Table(name="supplies", indexes={@ORM\Index(name="IDX_EC2D5CE86FFD5800", columns={"supply_product"}), @ORM\Index(name="IDX_EC2D5CE841544050", columns={"supply_contract"})})
 * @ORM\Entity
 */
class Supplies
{
    /**
     * @var int
     *
     * @ORM\Column(name="supply_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="supplies_supply_id_seq", allocationSize=1, initialValue=1)
     */
    private $supplyId;

    /**
     * @var int
     *
     * @ORM\Column(name="supply_quantity", type="integer", nullable=false)
     */
    private $supplyQuantity = 0;

    /**
     * @var Products
     *
     * @ORM\ManyToOne(targetEntity="Products", inversedBy="productSupplies")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="supply_product", referencedColumnName="product_id")
     * })
     */
    private $supplyProduct;

    /**
     * @var Contracts
     *
     * @ORM\ManyToOne(targetEntity="Contracts", inversedBy="contractSupplies")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="supply_contract", referencedColumnName="contract_id", onDelete="SET NULL")
     * })
     */
    private $supplyContract;

    /**
     * @return int
     */
    public function getSupplyId(): int
    {
        return $this->supplyId;
    }

    public function setSupplyId(int $supplyId): void
    {
        $this->supplyId = $supplyId;
    }

    public function getSupplyQuantity()
    {
        return $this->supplyQuantity;
    }

    /**
     * @param int $supplyQuantity
     */
    public function setSupplyQuantity(int $supplyQuantity): void
    {
        $this->supplyQuantity = $supplyQuantity;
    }

    /**
     * @return Products|null
     */
    public function getSupplyProduct(): ?Products
    {
        return $this->supplyProduct;
    }

    /**
     * @param Products $supplyProduct
     */
    public function setSupplyProduct(Products $supplyProduct): void
    {
        $this->supplyProduct = $supplyProduct;
    }

    /**
     * @return Contracts|null
     */
    public function getSupplyContract(): ?Contracts
    {
        return $this->supplyContract;
    }

    /**
     * @param Contracts $supplyContract
     */
    public function setSupplyContract(Contracts $supplyContract): void
    {
        $this->supplyContract = $supplyContract;
    }


}

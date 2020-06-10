<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Supplies
 *
 * @ORM\Table(
 *      name="supplies",
 *      indexes={@ORM\Index(name="IDX_EC2D5CE86FFD5800",
 *      columns={"supply_product"}),
 *      @ORM\Index(name="IDX_EC2D5CE841544050",
 *      columns={"supply_contract"})}
 *     )
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
     * @ORM\Column(name="contract_supply_date", type="date", nullable=true)
     */
    private $supplyDate;

    /**
     * @var Measure $supplyMeasure
     * @ORM\ManyToOne(targetEntity="Measure")
     * @ORM\JoinColumn(name="measure_id", referencedColumnName="id")
     */
    private $supplyMeasure;

    /**
     * @return Measure
     */
    public function getSupplyMeasure(): Measure
    {
        return $this->supplyMeasure;
    }

    /**
     * @param Measure $supplyMeasure
     */
    public function setSupplyMeasure(Measure $supplyMeasure): void
    {
        $this->supplyMeasure = $supplyMeasure;
    }

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

    public function getSupplyQuantity(): int
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

    /**
     * @return DateTime
     */
    public function getSupplyDate(): DateTime
    {
        return $this->supplyDate;
    }

    /**
     * @param DateTime $supplyDate
     */
    public function setSupplyDate($supplyDate): void
    {
        $this->supplyDate = $supplyDate;
    }
}

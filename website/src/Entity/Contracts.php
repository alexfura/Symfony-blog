<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Contracts
 *
 * @ORM\Table(name="contracts")
 * @ORM\Entity
 */
class Contracts
{
    /**
     * @var int
     *
     * @ORM\Column(name="contract_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="contracts_contract_id_seq", allocationSize=1, initialValue=1)
     */
    private $contractId;

    /**
     * @var int
     *
     * @ORM\Column(name="contract_price", type="integer", nullable=false)
     */
    private $contractPrice;

    /**
     * @var int|null
     *
     * @ORM\Column(name="contract_sale", type="integer", nullable=true)
     */
    private $contractSale;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="contract_signature_date", type="date", nullable=false, options={"default"="CURRENT_DATE"})
     */
    private $contractSignatureDate = 'CURRENT_DATE';

    /**
     * @var DateTime
     *
     * @ORM\Column(name="contract_supply_date", type="date", nullable=false)
     */
    private $contractSupplyDate;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="Customers", mappedBy="customerContract")
     */
    private $contractCustomers;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="Suppliers", mappedBy="supplierContract")
     */
    private $contractSuppliers;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="Supplies", mappedBy="supplyContract")
     */
    private $contractSupplies;

    /**
     * @return mixed
     */
    public function getContractSupplies()
    {
        return $this->contractSupplies;
    }

    /**
     * @param mixed $contractSupplies
     */
    public function setContractSupplies($contractSupplies): void
    {
        $this->contractSupplies = $contractSupplies;
    }

    /**
     * @return int
     */
    public function getContractId(): int
    {
        return $this->contractId;
    }

    /**
     * @param int $contractId
     */
    public function setContractId(int $contractId): void
    {
        $this->contractId = $contractId;
    }

    /**
     * @return int
     */
    public function getContractPrice(): int
    {
        return $this->contractPrice;
    }

    /**
     * @param int $contractPrice
     */
    public function setContractPrice(int $contractPrice): void
    {
        $this->contractPrice = $contractPrice;
    }

    /**
     * @return int|null
     */
    public function getContractSale(): ?int
    {
        return $this->contractSale;
    }

    /**
     * @param int|null $contractSale
     */
    public function setContractSale(?int $contractSale): void
    {
        $this->contractSale = $contractSale;
    }

    /**
     * @return DateTime
     */
    public function getContractSignatureDate(): DateTime
    {
        return $this->contractSignatureDate;
    }

    /**
     * @param DateTime $contractSignatureDate
     */
    public function setContractSignatureDate(DateTime $contractSignatureDate): void
    {
        $this->contractSignatureDate = $contractSignatureDate;
    }

    /**
     * @return DateTime
     */
    public function getContractSupplyDate(): DateTime
    {
        return $this->contractSupplyDate;
    }

    /**
     * @param DateTime $contractSupplyDate
     */
    public function setContractSupplyDate(DateTime $contractSupplyDate): void
    {
        $this->contractSupplyDate = $contractSupplyDate;
    }

    /**
     * @return mixed
     */
    public function getContractCustomers()
    {
        return $this->contractCustomers;
    }

    /**
     * @param mixed $contractCustomers
     */
    public function setContractCustomers($contractCustomers): void
    {
        $this->contractCustomers = $contractCustomers;
    }

    /**
     * @return mixed
     */
    public function getContractSuppliers()
    {
        return $this->contractSuppliers;
    }

    /**
     * @param mixed $contractSuppliers
     */
    public function setContractSuppliers($contractSuppliers): void
    {
        $this->contractSuppliers = $contractSuppliers;
    }


}

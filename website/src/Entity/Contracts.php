<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Contracts
 *
 * @ORM\Table(name="contracts")
 * @ORM\Entity
 */
class Contracts
{
    public const STATUS_SIGNED = 1;
    public const STATUS_UNSIGNED = 10;
    public const STATUS_CANCELED = 100;

    public const STATUS_SIGNED_TITLE = 'Signed';
    public const STATUS_UNSIGNED_TITLE = 'Unsigned';
    public const STATUS_CANCELED_TITLE = 'Canceled';

    public const CONTRACT_TITLE_TO_STATUS_LIST = [
      self::STATUS_SIGNED_TITLE => self::STATUS_SIGNED,
      self::STATUS_UNSIGNED_TITLE => self::STATUS_UNSIGNED,
      self::STATUS_CANCELED_TITLE => self::STATUS_CANCELED
    ];

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
     * @Assert\Range(min=0, max=100, notInRangeMessage="Value must be from 0 to 100")
     */
    private $contractSale;

    /**
     * @ORM\Column(name="contract_signature_date", type="date", nullable=true, options={"default"="CURRENT_DATE"})
     */
    private $contractSignatureDate;

    /**
     * @ORM\Column(name="contract_supply_date", type="date", nullable=true)
     */
    private $contractSupplyDate;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="Customers", inversedBy="customerContracts")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="contract_customer", referencedColumnName="customer_id", onDelete="SET NULL")
     * })
     */
    private $contractCustomer;

    /**
     * @var
     * @ORM\ManyToOne(targetEntity="Suppliers", inversedBy="supplierContracts")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="contract_supplier", referencedColumnName="supplier_id", onDelete="SET NULL")
     * })
     */
    private $contractSupplier;

    /**
     * @var
     * @ORM\OneToMany(targetEntity="Supplies", mappedBy="supplyContract")
     */
    private $contractSupplies;

    /**
     * @var string $contractStatus
     * @ORM\Column(name="contract_status", type="integer", nullable=false)
     */
    private $contractStatus = self::STATUS_UNSIGNED;

    public function __construct()
    {
        $this->contractSupplies = new ArrayCollection();
    }

    /**
     * @return Customers|null
     */
    public function getContractCustomer(): ?Customers
    {
        return $this->contractCustomer;
    }

    /**
     * @param Customers $contractCustomer
     */
    public function setContractCustomer(Customers $contractCustomer): void
    {
        $this->contractCustomer = $contractCustomer;
    }

    /**
     * @return mixed
     */
    public function getContractSupplier()
    {
        return $this->contractSupplier;
    }

    /**
     * @param Suppliers $contractSupplier
     */
    public function setContractSupplier($contractSupplier): void
    {
        $this->contractSupplier = $contractSupplier;
    }

    /**
     * @return int
     */
    public function getContractStatus(): int
    {
        return $this->contractStatus;
    }

    /**
     * @param int $contractStatus
     */
    public function setContractStatus(int $contractStatus): void
    {
        $this->contractStatus = $contractStatus;
    }

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
     * @return int|null
     */
    public function getContractPrice(): ?int
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


    public function getContractSignatureDate(): ?\DateTimeInterface
    {
        return $this->contractSignatureDate;
    }


    public function setContractSignatureDate(DateTime $contractSignatureDate): void
    {
        $this->contractSignatureDate = $contractSignatureDate;
    }

    public function getContractSupplyDate(): ?\DateTimeInterface
    {
        return $this->contractSupplyDate;
    }

    public function setContractSupplyDate(DateTime $contractSupplyDate): void
    {
        $this->contractSupplyDate = $contractSupplyDate;
    }
}

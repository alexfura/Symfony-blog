<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Suppliers
 *
 * @ORM\Table(name="suppliers", indexes={@ORM\Index(name="IDX_AC28B95C640640D8", columns={"supplier_contract"})})
 * @ORM\Entity
 */
class Suppliers
{
    /**
     * @var int
     *
     * @ORM\Column(name="supplier_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="suppliers_supplier_id_seq", allocationSize=1, initialValue=1)
     */
    private $supplierId;

    /**
     * @var string
     *
     * @ORM\Column(name="supplier_name", type="string", length=40, nullable=false)
     */
    private $supplierName;

    /**
     * @var string
     *
     * @ORM\Column(name="supplier_second_name", type="string", length=40, nullable=false)
     */
    private $supplierSecondName;

    /**
     * @var string
     *
     * @ORM\Column(name="supplier_address", type="string", length=40, nullable=false)
     */
    private $supplierAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="supplier_phone", type="string", length=40, nullable=false)
     */
    private $supplierPhone;

    /**
     * @var Contracts
     *
     * @ORM\ManyToOne(targetEntity="Contracts", inversedBy="contractSuppliers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="supplier_contract", referencedColumnName="contract_id", onDelete="SET NULL")
     * })
     */
    private $supplierContract;

    /**
     * @return int
     */
    public function getSupplierId(): int
    {
        return $this->supplierId;
    }

    /**
     * @param int $supplierId
     */
    public function setSupplierId(int $supplierId): void
    {
        $this->supplierId = $supplierId;
    }

    /**
     * @return string
     */
    public function getSupplierName(): string
    {
        return $this->supplierName;
    }

    /**
     * @param string $supplierName
     */
    public function setSupplierName(string $supplierName): void
    {
        $this->supplierName = $supplierName;
    }

    /**
     * @return string
     */
    public function getSupplierSecondName(): string
    {
        return $this->supplierSecondName;
    }

    /**
     * @param string $supplierSecondName
     */
    public function setSupplierSecondName(string $supplierSecondName): void
    {
        $this->supplierSecondName = $supplierSecondName;
    }

    /**
     * @return string
     */
    public function getSupplierAddress(): string
    {
        return $this->supplierAddress;
    }

    /**
     * @param string $supplierAddress
     */
    public function setSupplierAddress(string $supplierAddress): void
    {
        $this->supplierAddress = $supplierAddress;
    }

    /**
     * @return string
     */
    public function getSupplierPhone(): string
    {
        return $this->supplierPhone;
    }

    /**
     * @param string $supplierPhone
     */
    public function setSupplierPhone(string $supplierPhone): void
    {
        $this->supplierPhone = $supplierPhone;
    }

    /**
     * @return Contracts
     */
    public function getSupplierContract(): Contracts
    {
        return $this->supplierContract;
    }

    /**
     * @param Contracts $supplierContract
     */
    public function setSupplierContract(Contracts $supplierContract): void
    {
        $this->supplierContract = $supplierContract;
    }


}

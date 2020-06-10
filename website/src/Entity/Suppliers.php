<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Suppliers
 *
 * @ORM\Table(name="suppliers")
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
     * @var string $supplierName
     *
     * @ORM\Column(name="supplier_name", type="string", length=40, nullable=false)
     */
    private $supplierName;

    /**
     * @var string $supplierSecondName
     *
     * @ORM\Column(name="supplier_second_name", type="string", length=40, nullable=false)
     */
    private $supplierSecondName;

    /**
     * @var string $supplierAddress
     *
     * @ORM\Column(name="supplier_address", type="string", length=40, nullable=false)
     */
    private $supplierAddress;

    /**
     * @var string $supplierPhone
     *
     * @ORM\Column(name="supplier_phone", type="string", length=40, nullable=false)
     */
    private $supplierPhone;

    /**
     * @var ArrayCollection $supplierContracts
     *
     * @ORM\OneToMany(targetEntity="Contracts", mappedBy="contractSupplier")
     */
    private $supplierContracts;

    public function __construct()
    {
        $this->supplierContracts = new ArrayCollection();
    }

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
    public function getSupplierName(): ?string
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
    public function getSupplierSecondName(): ?string
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
    public function getSupplierAddress(): ?string
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
    public function getSupplierPhone(): ?string
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
}

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
     * @var \Contracts
     *
     * @ORM\ManyToOne(targetEntity="Contracts")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="supplier_contract", referencedColumnName="contract_id")
     * })
     */
    private $supplierContract;


}

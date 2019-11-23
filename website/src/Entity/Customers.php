<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Customers
 *
 * @ORM\Table(name="customers", indexes={@ORM\Index(name="IDX_62534E21C54A6B76", columns={"customer_contract"})})
 * @ORM\Entity
 */
class Customers
{
    /**
     * @var int
     *
     * @ORM\Column(name="customer_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="customers_customer_id_seq", allocationSize=1, initialValue=1)
     */
    private $customerId;

    /**
     * @var string
     *
     * @ORM\Column(name="customer_first_name", type="string", length=40, nullable=false)
     */
    private $customerFirstName;

    /**
     * @var string
     *
     * @ORM\Column(name="customer_second_name", type="string", length=40, nullable=false)
     */
    private $customerSecondName;

    /**
     * @var string
     *
     * @ORM\Column(name="customer_phone", type="string", length=15, nullable=false)
     */
    private $customerPhone;

    /**
     * @var \Contracts
     *
     * @ORM\ManyToOne(targetEntity="Contracts")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="customer_contract", referencedColumnName="contract_id")
     * })
     */
    private $customerContract;


}

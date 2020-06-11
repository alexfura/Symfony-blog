<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Customers
 *
 * @ORM\Table(name="customers")
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
     * @ORM\Column(name="customer_first_name", type="string", length=225, nullable=false)
     */
    private $customerFirstName;

    /**
     * @var string
     *
     * @ORM\Column(name="customer_second_name", type="string", length=225, nullable=false)
     */
    private $customerSecondName;

    /**
     * @var string
     *
     * @ORM\Column(name="customer_phone", type="string", length=40, nullable=false)
     */
    private $customerPhone;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Contracts", mappedBy="contractCustomer")
     */
    private $customerContracts;

    public function __construct()
    {
        $this->customerContracts = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getCustomerId(): int
    {
        return $this->customerId;
    }


    public function setCustomerId(int $customerId): void
    {
        $this->customerId = $customerId;
    }

    public function getCustomerFirstName(): ?string
    {
        return $this->customerFirstName;
    }


    public function setCustomerFirstName(string $customerFirstName): void
    {
        $this->customerFirstName = $customerFirstName;
    }


    public function getCustomerSecondName(): ?string
    {
        return $this->customerSecondName;
    }

    /**
     * @param string $customerSecondName
     */
    public function setCustomerSecondName(string $customerSecondName): void
    {
        $this->customerSecondName = $customerSecondName;
    }


    public function getCustomerPhone(): ?string
    {
        return $this->customerPhone;
    }


    public function setCustomerPhone(string $customerPhone): void
    {
        $this->customerPhone = $customerPhone;
    }
}

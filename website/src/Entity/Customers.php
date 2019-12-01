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
     * @var Contracts
     *
     * @ORM\ManyToOne(targetEntity="Contracts", inversedBy="contractCustomers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="customer_contract", referencedColumnName="contract_id")
     * })
     */
    private $customerContract;

    /**
     * @return int
     */
    public function getCustomerId(): int
    {
        return $this->customerId;
    }

    /**
     * @param int $customerId
     */
    public function setCustomerId(int $customerId): void
    {
        $this->customerId = $customerId;
    }

    /**
     * @return string
     */
    public function getCustomerFirstName(): string
    {
        return $this->customerFirstName;
    }

    /**
     * @param string $customerFirstName
     */
    public function setCustomerFirstName(string $customerFirstName): void
    {
        $this->customerFirstName = $customerFirstName;
    }

    /**
     * @return string
     */
    public function getCustomerSecondName(): string
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

    /**
     * @return string
     */
    public function getCustomerPhone(): string
    {
        return $this->customerPhone;
    }

    /**
     * @param string $customerPhone
     */
    public function setCustomerPhone(string $customerPhone): void
    {
        $this->customerPhone = $customerPhone;
    }

    /**
     * @return Contracts
     */
    public function getCustomerContract(): Contracts
    {
        return $this->customerContract;
    }

    /**
     * @param Contracts $customerContract
     */
    public function setCustomerContract(Contracts $customerContract): void
    {
        $this->customerContract = $customerContract;
    }


}

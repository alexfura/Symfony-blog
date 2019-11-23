<?php

namespace App\Entity;

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
     * @var \DateTime
     *
     * @ORM\Column(name="contract_signature_date", type="date", nullable=false, options={"default"="CURRENT_DATE"})
     */
    private $contractSignatureDate = 'CURRENT_DATE';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="contract_supply_date", type="date", nullable=false)
     */
    private $contractSupplyDate;


}

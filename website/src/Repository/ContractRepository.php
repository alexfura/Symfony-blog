<?php declare(strict_types=1);


namespace App\Repository;


use App\Entity\Contracts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\DBALException;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ContractRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contracts::class);
    }

    /**
     * @param int $countOfMonths
     * @return array|null
     * @throws DBALException
     */
    public function getContractsWithExpiredSuppliesForLast3Months(): ?array
    {
        $sql = <<<EOT
        SELECT DISTINCT contracts.contract_id, EXTRACT(YEAR FROM AGE(CURRENT_DATE, contract_signature_date)) AS YEARS,
        EXTRACT(MONTH FROM AGE(CURRENT_DATE, contract_signature_date)) AS MONTHS,
        EXTRACT(DAY FROM AGE(CURRENT_DATE, contract_signature_date)) AS DAYS
        FROM contracts
        JOIN supplies ON supplies.supply_contract = contracts.contract_id AND
        EXTRACT(YEAR FROM AGE(contracts.contract_signature_date , supplies.supply_date )) < 0 OR
        EXTRACT(MONTH FROM AGE(contracts.contract_signature_date, supplies.supply_date)) < 0 OR
        EXTRACT(DAY FROM AGE(contracts.contract_signature_date, supplies.supply_date)) < 0
        WHERE EXTRACT(YEAR FROM AGE(CURRENT_DATE, contract_signature_date)) = 0 AND
        EXTRACT(MONTH FROM AGE(CURRENT_DATE, contract_signature_date)) >= 0 AND
        EXTRACT(MONTH FROM AGE(CURRENT_DATE, contract_signature_date)) <= 3
        ORDER BY EXTRACT(YEAR FROM AGE(CURRENT_DATE, contract_signature_date)),
        EXTRACT(MONTH FROM AGE(CURRENT_DATE, contract_signature_date)),
        EXTRACT(DAY FROM AGE(CURRENT_DATE, contract_signature_date)) DESC;
EOT;
        $connection = $this->getEntityManager()->getConnection();
        $statement = $connection->query($sql);

        return $statement->fetchAll();
    }
}
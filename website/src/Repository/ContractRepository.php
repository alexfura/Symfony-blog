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
    public function getContractsWithExpiredSuppliesForLastNMonths(int $countOfMonths): ?array
    {
        $sql = <<<EOT
        SELECT DISTINCT Contract.id, EXTRACT(YEAR FROM AGE(CURRENT_DATE, signature_date)) AS YEARS,
        EXTRACT(MONTH FROM AGE(CURRENT_DATE, signature_date)) AS MONTHS,
        EXTRACT(DAY FROM AGE(CURRENT_DATE, signature_date)) AS DAYS
        FROM Contract
        JOIN Supply ON Supply.contract_id = Contract.id AND
        EXTRACT(YEAR FROM AGE(Contract.signature_date, Supply.supply_date)) < 0 OR
        EXTRACT(MONTH FROM AGE(Contract.signature_date, Supply.supply_date)) < 0 OR
        EXTRACT(DAY FROM AGE(Contract.signature_date, Supply.supply_date)) < 0
        WHERE EXTRACT(YEAR FROM AGE(CURRENT_DATE, signature_date)) = 0 AND
        EXTRACT(MONTH FROM AGE(CURRENT_DATE, signature_date)) >= 0 AND
        EXTRACT(MONTH FROM AGE(CURRENT_DATE, signature_date)) <= 3
        ORDER BY EXTRACT(YEAR FROM AGE(CURRENT_DATE, signature_date)),
        EXTRACT(MONTH FROM AGE(CURRENT_DATE, signature_date)),
        EXTRACT(DAY FROM AGE(CURRENT_DATE, signature_date)) DESC;
EOT;
        $connection = $this->getEntityManager()->getConnection();
        $statement = $connection->query($sql);

        return $statement->fetchAll();
    }
}
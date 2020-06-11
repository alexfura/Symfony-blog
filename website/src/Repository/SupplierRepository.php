<?php


namespace App\Repository;


use App\Entity\Suppliers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Driver\PDOException;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;
use Doctrine\Persistence\ManagerRegistry;

class SupplierRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Suppliers::class);
    }

    /**
     * @return array|null
     * @throws DBALException
     */
    public function getSuppliersRatedByExpiredContractCount(): ?array
    {
        $sql = <<<'EOT'
        WITH SUPPLIERS AS(
            SELECT suppliers.supplier_first_name AS SUPPLIER, AGE(contracts.contract_signature_date, supplies.supply_date ) AS SUPPLY_TIME
            FROM contracts
            JOIN supplies ON supplies.supply_contract = contracts.contract_id 
            JOIN suppliers ON suppliers.supplier_id = contracts.contract_supplier 
        )
        SELECT SUPPLIER, 'GOOD' as supplier_type FROM SUPPLIERS
        WHERE EXTRACT(YEAR FROM SUPPLY_TIME) > 0 AND
        EXTRACT(MONTH FROM SUPPLY_TIME) > 0 AND
        EXTRACT(DAY FROM SUPPLY_TIME) > 0
        UNION
        SELECT SUPPLIER, 'BAD' as supplier_type FROM SUPPLIERS
        WHERE EXTRACT(YEAR FROM SUPPLY_TIME) < 0 AND
        EXTRACT(MONTH FROM SUPPLY_TIME) < 0 AND
        EXTRACT(DAY FROM SUPPLY_TIME) < 0
        UNION
        SELECT SUPPLIER, 'OTHER' as supplier_type FROM SUPPLIERS
        WHERE SUPPLIER NOT IN(
            SELECT SUPPLIER FROM SUPPLIERS
        WHERE EXTRACT(YEAR FROM SUPPLY_TIME) > 0 AND
        EXTRACT(MONTH FROM SUPPLY_TIME) > 0 AND
        EXTRACT(DAY FROM SUPPLY_TIME) > 0
        UNION
        SELECT SUPPLIER FROM SUPPLIERS
        WHERE EXTRACT(YEAR FROM SUPPLY_TIME) < 0 AND
        EXTRACT(MONTH FROM SUPPLY_TIME) < 0 AND
        EXTRACT(DAY FROM SUPPLY_TIME) < 0);
EOT;

        $connection = $this->getEntityManager()->getConnection();
        $statement = $connection->query($sql);

        return $statement->fetchAll();
    }
}
<?php declare(strict_types=1);

namespace App\Repository;
use App\Entity\Products;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\DBALException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class ProductRepository
 * @package App\Repository
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Products::class);
    }

    /**
     * @return array|null
     * @throws DBALException
     */
    public function findAllProductsWithExpiryDateLessThanWeek(): ?array
    {
        $sql = <<<EOT
SELECT product_name AS PRODUCT FROM products 
where
EXTRACT(YEAR FROM AGE(products.product_exp_date, current_date)) = 0 AND
EXTRACT(MONTH FROM AGE(products.product_exp_date, current_date)) = 0 AND
EXTRACT(DAY FROM AGE(products.product_exp_date, current_date)) <= 7 AND
EXTRACT(DAY FROM AGE(products.product_exp_date, current_date)) >= 0;
EOT;
        $connection = $this->getEntityManager()->getConnection();
        $statement = $connection->query($sql);

        return $statement->fetchAll();
    }
}
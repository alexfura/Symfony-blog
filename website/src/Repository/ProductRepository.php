<?php declare(strict_types=1);


namespace App\Repository;


use Doctrine\ORM\EntityRepository;

class ProductRepository extends EntityRepository
{
    /**
     * @param string $dateToCompare
     * @return array|null
     */
    public function findAllProductsWithExpiryDateLessThan(string $dateToCompare): ?array
    {
        return [];
    }

    
}
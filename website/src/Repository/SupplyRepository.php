<?php


namespace App\Repository;


use App\Entity\Supplies;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class SupplyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Supplies::class);
    }

    public function getSuppliesForEachProductPerMonth()
    {
        return [];
    }
}
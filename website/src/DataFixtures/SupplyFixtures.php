<?php

namespace App\DataFixtures;

use App\Entity\Contracts;
use App\Entity\Products;
use App\Entity\Supplies;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

/**
 * Class SupplyFixtures
 * @package App\DataFixtures
 */
class SupplyFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i = 0;$i < 150;$i++)
        {
            $contractsRepository = $manager->getRepository(Contracts::class);
            $productRepository = $manager->getRepository(Products::class);

            /**
             * @var Contracts [] $contracts
             */
            $contracts = $contractsRepository->findBy([], null, 50);
            /**
             * @var Products [] $products
             */
            $products = $productRepository->findBy([], null, 20);

            $supply = new Supplies();
            $supply->setSupplyContract($contracts[intval(array_rand($contracts))]);
            $supply->setSupplyProduct($products[intval(array_rand($products))]);
            $supply->setSupplyDate(new \DateTime());
            $supply->setSupplyMeasure(null);
            $supply->setSupplyQuantity(rand(1000, 10000));
            $manager->persist($supply);
        }

        $manager->flush();
    }
}

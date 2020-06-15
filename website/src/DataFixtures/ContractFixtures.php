<?php

namespace App\DataFixtures;

use App\Entity\Contracts;
use App\Entity\Customers;
use App\Entity\Suppliers;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

/**
 * Class ContractFixtures
 * @package App\DataFixtures
 */
class ContractFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $customersRepository = $manager->getRepository(Customers::class);
        $suppliersRepository = $manager->getRepository(Suppliers::class);

        /**
         * @var Suppliers [] $suppliers
         */
        $suppliers = $suppliersRepository->findBy([], null, 13);
        /**
         * @var Customers [] $customers
         */
        $customers = $customersRepository->findBy([], null, 13);


        for($i = 0;$i < 100;$i++)
        {
            $contract = new Contracts();
            $contract->setContractCustomer($customers[intval(array_rand($customers))]);
            $contract->setContractSupplier($suppliers[intval(array_rand($suppliers))]);
            $contract->setContractPrice(rand(1000, 100000));
            $contract->setContractSale(rand(0, 20));
            $contract->setContractSignatureDate(new \DateTime());
            $contract->setContractSupplyDate(new \DateTime());
            $manager->persist($contract);
        }

        $manager->flush();
    }

    /**
     * @return string[]
     */
    public function getDependencies(): array
    {
        return [
            CustomerFixtures::class,
            SupplierFixtures::class
        ];
    }
}

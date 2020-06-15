<?php

namespace App\DataFixtures;

use App\Entity\Suppliers;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Provider\en_US\Person;

/**
 * Class SupplierFixtures
 * @package App\DataFixtures
 */
class SupplierFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        $provider = new Person($faker);
        $faker->addProvider($provider);

        for ($i = 0;$i < 20;$i++)
        {
            $supplier = new Suppliers();
            $supplier->setSupplierFirstName($faker->name);
            $supplier->setSupplierSecondName($faker->lastName);
            $supplier->setSupplierPhone($faker->phoneNumber);
            $supplier->setSupplierAddress($faker->address);
            $manager->persist($supplier);
        }

        $manager->flush();
    }
}

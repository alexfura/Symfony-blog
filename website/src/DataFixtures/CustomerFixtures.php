<?php

namespace App\DataFixtures;

use App\Entity\Customers;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Provider\en_US\Person;

/**
 * Class CustomerFixtures
 * @package App\DataFixtures
 */
class CustomerFixtures extends Fixture
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
            $supplier = new Customers();
            $supplier->setCustomerFirstName($faker->name);
            $supplier->setCustomerSecondName($faker->lastName);
            $supplier->setCustomerPhone($faker->phoneNumber);
            $manager->persist($supplier);
        }

        $manager->flush();
    }
}

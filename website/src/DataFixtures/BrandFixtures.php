<?php

namespace App\DataFixtures;

use App\Entity\Brands;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Provider\en_US\Company;

class BrandFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        $provider = new Company($faker);
        $faker->addProvider($provider);
        for($i = 0;$i < 10;$i++)
        {
            $brand = new Brands();
            $brand->setBrandName($faker->company);
            $manager->persist($brand);
        }
        $manager->flush();
    }
}

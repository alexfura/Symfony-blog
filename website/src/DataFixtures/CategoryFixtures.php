<?php

namespace App\DataFixtures;

use App\Entity\Categories;
use Bezhanov\Faker\Provider\Commerce;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CategoryFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        $provider = new Commerce($faker);
        $faker->addProvider($provider);
        for($i = 0;$i < 10;$i++)
        {
            $category = new Categories();
            $category->setCategoryName($faker->department);
            $manager->persist($category);
        }
        $manager->flush();
    }
}

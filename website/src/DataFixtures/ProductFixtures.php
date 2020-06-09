<?php

namespace App\DataFixtures;

use App\Entity\Products;
use Bezhanov\Faker\Provider\Commerce;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        $provider = new Commerce($faker);
        $faker->addProvider($provider);
        for($i = 0;$i < 100;$i++)
        {
            $product = new Products();
            $product->setProductName($faker->productName);
            $product->setProductBrand(null);
            $product->setProductCategory(null);
            $product->setProductExpDate(null);
            $product->setProductManDate(null);

        }
    }
}

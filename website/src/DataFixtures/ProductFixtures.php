<?php

namespace App\DataFixtures;

use App\Entity\Brands;
use App\Entity\Categories;
use App\Entity\Products;
use Bezhanov\Faker\Provider\Commerce;
use DateInterval;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $brandRepository = $manager->getRepository(Brands::class);
        $categoryRepository = $manager->getRepository(Categories::class);

        /**
         * @var Brands [] $brands
         */
        $brands = $brandRepository->findBy([], null, 10);
        /**
         * @var Categories [] $categories
         */
        $categories = $categoryRepository->findBy([], null, 10);

        $faker = Factory::create();
        $provider = new Commerce($faker);
        $faker->addProvider($provider);
        for($i = 0;$i < 30;$i++)
        {
            $product = new Products();
            $product->setProductName($faker->productName);
            $product->setProductBrand($brands[intval(array_rand($brands, 1))]);
            $product->setProductCategory($categories[intval(array_rand($categories, 1))]);

            $product->setProductExpDate(new \DateTime());
            $product->setProductManDate((new \DateTime())->add(new DateInterval('P10D')));
            $manager->persist($product);
        }
        $manager->flush();
    }
}

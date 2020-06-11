<?php

namespace App\DataFixtures;

use App\Entity\Measure;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

/**
 * Class MeasureFixtures
 * @package App\DataFixtures
 */
class MeasureFixtures extends Fixture
{
    private const DEFAULT_MEASURE_NAMES = [
      'kg',
      'm',
      'sm',
      'l',
      'sqr',
      'g'
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::DEFAULT_MEASURE_NAMES as $measureName)
        {
            $measure = new Measure();
            $measure->setMeasureName($measureName);
            $manager->persist($measure);
        }

        $manager->flush();
    }
}

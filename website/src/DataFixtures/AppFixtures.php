<?php

namespace App\DataFixtures;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i = 0;$i < 10;$i++)
        {
            $user = new User();
            $user->setBio("random string");
            $user->setUsername("user$i");
            $user->setFirstName("fname$i");
            $user->setSecondName("sname$i");
            $user->setStatus(true);
            $user->setEmail("email$i@example.com");
            $user->setPassword("test_password");
            $manager->persist($user);
        }

        $manager->flush();
    }
}

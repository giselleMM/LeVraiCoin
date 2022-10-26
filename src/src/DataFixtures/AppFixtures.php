<?php

namespace App\DataFixtures;

use App\Factory\PostFactory;
use App\Factory\UserFactory;
use App\Factory\TagFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // create 10 Category's
        UserFactory::createMany(10);

        // create 20 Tag's
        TagFactory::createMany(20);

        // create 50 Post's
        PostFactory::createMany(50, function() {
            return [
                // each Post will have a random Category (chosen from those created above)
                'user' => UserFactory::random(),
             ];
        });
    }
}
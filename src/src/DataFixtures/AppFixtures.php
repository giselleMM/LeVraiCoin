<?php

namespace App\DataFixtures;

use App\Entity\PicturePost;
use App\Factory\PicturePostFactory;
use App\Factory\PostFactory;
use App\Factory\UserFactory;
use App\Factory\TagFactory;
use App\Factory\QuestionFactory;
use App\Factory\ResponseFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // create 10 Category's
        UserFactory::createMany(10);

        // create 20 Tag's
        TagFactory::createMany(5);

        // create 50 Post's
        PostFactory::createMany(5, function() {
            return [
                // each Post will have a random Category (chosen from those created above)
                'user' => UserFactory::random(),
                'tag' => TagFactory::random(),
                'pictures' => PicturePostFactory::new()->many(2),
             ];
        });

        QuestionFactory::createMany(5, function() {
            return [
                // each Post will have a random Category (chosen from those created above)
                'author' => UserFactory::random(),
                'post' => PostFactory::random(),
             ];
        });

        ResponseFactory::createMany(5, function() {
            return [
                // each Post will have a random Category (chosen from those created above)
                'question' => QuestionFactory::random(),
                'author' => UserFactory::random(),
             ];
        });
    }
}
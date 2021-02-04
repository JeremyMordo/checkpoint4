<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Comment;
use App\Entity\User;
use Faker;

class CommentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // add 10 comments

        $faker = Faker\Factory::create('fr_FR');
        for ($i = 1; $i <= 10; $i++) {
            $comment = new Comment();
            $user = new User();
            $comment->setDescription($faker->text($maxNbChars = rand(100, 200)));
            $comment->setDatetime($faker->dateTimeBetween($startDate = '-30 years', $endDate = 'now', $timezone = null));
            $comment->setAuthor($this->getReference("user_" . rand(1, 10), $user));
            $comment->setGrade(rand(0, 5));

            $manager->persist($comment);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [UserFixtures::class];
    }
}

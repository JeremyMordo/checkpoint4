<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker;


class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public const ADMIN = [
        'Jérémy' => [
            'lastname' => 'Mordo',
            'email' => 'jeremymordo@gmail.com',
            'roles' => ['ROLE_ADMIN'],
            'isActive' => 0,
        ],
    ];

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        // add account administrator

        foreach (self::ADMIN as $key => $value) {
            $admin = new User();
            $admin->setFirstName($key);
            $admin->setLastName($value['lastname']);
            $admin->setEmail($value['email']);
            $admin->setPassword($this->passwordEncoder->encodePassword($admin, 'admin'));
            $admin->setRoles($value['roles']);

            $manager->persist($admin);
        }

        // add 10 users

        $faker = Faker\Factory::create('fr_FR');
        for ($i = 1; $i <= 10; $i++) {
            $user = new User();
            $user->setFirstname($faker->firstName($gender = 'male' | 'female'));
            $user->setLastname($faker->lastName());
            $user->setEmail($faker->email());
            $user->setRoles(['ROLE_user']);
            $user->setPassword($this->passwordEncoder->encodePassword($user, $faker->word()));
            $this->addReference('user_' . $i, $user);

            $manager->persist($user);
        }

        $manager->flush();
    }
}

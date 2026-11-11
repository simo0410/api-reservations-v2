<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $users = [
            [
                'firstname'=>'Bob', 
                'lastname'=>'Sull',
                'email'=>'bob@sull.com',
                'password'=>'epfc',
                'role'=>'ROLE_ADMIN',
            ],

            [
                'firstname'=>'Lydia',
                'lastname'=>'Smith',
                'email'=>'lydia@sull.com',
                'password'=>'epfc',
                'role'=>'ROLE_USER',
            ]
        ];

        foreach($users as $row) {
            $user = new User();
            $user->setEmail($row['email']);
            $hashedPassword = $this->passwordHasher->hashPassword($user, $row['password']);
            $user->setPassword($hashedPassword);
            $user->setRoles([$row['role']]);
            $manager->persist($user);
        }

        $manager->flush();
    }
}

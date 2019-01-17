<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture
{

    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    /**
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $users = $this->createUsers();
        foreach ($users as $user) {
            $manager->persist($user);
        }

        $manager->flush();
        $manager->clear();
    }

    /**
     * @return array
     */
    public function createUsers()
    {
        $users = [];

        foreach ($this->getUsersData() as $datum) {
            $user = new User();
            $user
                ->setUsername($datum['name'])
                ->setRoles($datum['roles'])
                ->setPassword($this->encoder->encodePassword($user, $datum['password']));

            $users[] = $user;
        }

        return $users;
    }

    private function getUsersData()
    {
        return [
            [
                'name' => 'admin',
                'roles' => ['ROLE_ADMIN'],
                'password' => 'admin'
            ],
            [
                'name' => 'superadmin',
                'roles' => ['ROLE_SUPER_ADMIN'],
                'password' => 'superadmin'
            ]
        ];
    }
}

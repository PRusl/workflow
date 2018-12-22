<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture {

    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    /**
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(UserPasswordEncoderInterface $encoder) {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager) {
        $encoder = $this->encoder;

        foreach ($this->getUsersData() as $usersDatum) {
            $user = new User();
            $user
                ->setUsername($usersDatum['name'])
                ->setRoles($usersDatum['roles'])
                ->setPassword($encoder->encodePassword($user, $usersDatum['password']));

            $manager->persist($user);
        }

        $manager->flush();
        $manager->clear();
    }

    private function getUsersData() {
        return [
            [
                'name' => 'admin',
                'roles' => ['User::ROLE_ADMIN'],
                'password' => 'admin'
            ],
            [
                'name' => 'user',
                'roles' => ['User::ROLE_USER'],
                'password' => 'user'
            ]
        ];
    }
}

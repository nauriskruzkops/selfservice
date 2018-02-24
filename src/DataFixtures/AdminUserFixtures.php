<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminUserFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        if (!$manager->getRepository(User::class)->findOneBy(['username' => 'admin'])) {

            $user = new User();
            $user->setUsername('admin');
            $user->setRoles([User::ROLE_SUPER_ADMIN]);
            $user->setPassword($this->encoder->encodePassword($user, 'admin'));
            $user->setCreatedAt(new \DateTime());

            $manager->persist($user);
            $manager->flush();
        }
    }
}
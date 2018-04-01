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
        if (!($manager->getRepository(User::class)->findOneBy(['username' => 'system']))) {
            $systemUser = new User();
            $systemUser->setUsername('system');
            $systemUser->setRoles([User::ROLE_SUPER_ADMIN]);
            $systemUser->setPassword('DO-NOT-USE-THIS-USER');
            $manager->persist($systemUser);
        }

        if (!($manager->getRepository(User::class)->findOneBy(['username' => 'admin']))) {
            $adminUser = new User();
            $adminUser->setUsername('admin');
            $adminUser->setRoles([User::ROLE_SUPER_ADMIN]);
            $adminUser->setPassword($this->encoder->encodePassword($adminUser, 'admin'));
            $adminUser->setCreatedBy($systemUser);
            $manager->persist($adminUser);
        }

        $manager->flush();
        $manager->clear();
    }
}
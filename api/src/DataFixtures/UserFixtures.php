<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private UserPasswordEncoderInterface $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $admin = new User();
        $admin->setUsername('admin')
            ->setPassword($this->passwordEncoder->encodePassword($admin, 'admin'))
            ->setEmail('admin@admin.ad')
            ->setVoorletters('A')
            ->setTussenvoegsel('DM')
            ->setAchternaam('In')
            ->setAdres('yes')
            ->setPostcode('1111 AD')
            ->setWoonplaats('Admin city')
            ->setTelefoon('0612345678')
            ->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin);
        $manager->flush();
    }
}

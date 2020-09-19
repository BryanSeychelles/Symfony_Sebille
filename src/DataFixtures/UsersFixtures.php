<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\Users;

class UsersFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    public function __construct(UserPasswordEncoderInterface $encoder){

        $this->encoder = $encoder;

    }

    public function load(ObjectManager $manager)
    {
        $user= new Users();
            $user   ->setEmail('bryanseychellesyk@gmail.com')
                    ->setUsername("bry")
                    ->setPassword($this->encoder->encodePassword($user, 'Bryant789Ss'));
        $admin= new Users();
            $admin   ->setEmail('mickael.feret@orange.fr')
                    ->setUsername("Feret")
                    ->setPassword($this->encoder->encodePassword($admin, 'af29tx2'));

        $manager->persist($user);
        $manager->persist($admin);
        $manager->flush();
    }
}

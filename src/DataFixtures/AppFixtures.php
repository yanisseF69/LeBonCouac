<?php

namespace App\DataFixtures;

use Generator;
use App\Entity\User;
use App\Entity\Photo;
use App\Entity\Announcement;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\DBAL\Driver\IBMDB2\Exception\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {

        for($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setPseudo("yaya699")
                ->setEmail("yanisseferhaoui" . $i . "@gmail.com")
                ->setFirstName("Yanisse")
                ->setLastName("Ferhaoui")
                ->setRoles(['ROLE_ADMIN', 'ROLE_USER'])
                ->setPlainPassword('oueoue');
                

            $manager->persist($user);
        }

        for ($i=0; $i < 30; $i++) { 
            $annonce = new Announcement();
            $annonce->setTitle("Voiture pas cher oueoue")
                    ->setPrice(1500)
                    ->setDescription("Oueoue offre en or venez no noob")
                    ->setCity("Lyon(69)");
            $manager->persist($annonce);
            
        }
        

        $manager->flush();
    }
}

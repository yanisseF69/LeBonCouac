<?php

namespace App\DataFixtures;

use App\Entity\Announcement;
use App\Entity\Photo;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        // $user = new User();
        // $user->setUsername("yaya699")
        //     ->setEmail("yanisseferhaoui@gmail.com")
        //     ->setFirstName("Yanisse")
        //     ->setLastName("Ferhaoui")
        //     ->setPassword("oueoue");

        // $manager->persist($user);

        // for ($i=0; $i < 30; $i++) { 
        //     $annonce = new Announcement();
        //     $annonce->setTitle("Voiture pas cher oueoue")
        //             ->setPrice(1500)
        //             ->setDescription("Oueoue offre en or venez no noob")
        //             ->setCity("Lyon(69)")
        //             ->setIdU($user);
        //     $manager->persist($annonce);
        //     $photo = new Photo();
        //     $photo->setUrl("https://upload.wikimedia.org/wikipedia/commons/thumb/c/c6/Sign-check-icon.png/768px-Sign-check-icon.png")
        //         ->setIdA($annonce);
        //     $manager->persist($photo);
        // }
        

        $manager->flush();
    }
}

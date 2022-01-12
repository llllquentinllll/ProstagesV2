<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Entreprise;
use App\Entity\Formation;
use App\Entity\Stage;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker= \Faker\Factory::create('fr_FR');
        // $product = new Product();
        // $manager->persist($product);
        
        
        $unStage = new Stage();
        $unStage -> setTitre($faker->word);
        $unStage -> setMission($faker->word);
        $unStage -> setEmail($faker->email);

        $manager->persist($unStage);
        $manager->flush();

        


    
    }
}

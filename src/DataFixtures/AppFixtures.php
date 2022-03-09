<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Entreprise;
use App\Entity\Formation;
use App\Entity\Stage;
use App\Entity\User;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $quentin= new User();
        $quentin->setEmail("quentin@free.fr");
        $quentin->setRoles(['ROLE_USER','ROLE_ADMIN']);
        $quentin->setPassword('$2y$10$XWwzHwhayWI6QV8XeJaXDeD4aq.hQGzVj0vQALBUYuUguONAE2.Rq'); //Mdp: quentin
        $manager->persist($quentin);

        $matias= new User();
        $matias->setEmail("matias@free.fr");
        $matias->setRoles(['ROLE_USER']);
        $matias->setPassword('$2y$10$FTMTVUUvqR7q/3yJLMnfquXZ6R//rAC5rdS3quvXC00zGvSZMS5iu'); //Mdp: matias
        $manager->persist($matias);

        $faker= \Faker\Factory::create('fr_FR');
    
        // Gestion Entité Formation:

        $listeFormation=array();

        $listeNomCourt = array("DUT info","DUT Design","DUT Art","Bac S","Bac L","Licence Bio");
        $listeNomLong = array("Diplôme Universitaire Technologique Informatique","Diplôme Universitaire Technologique Design","Diplôme Universitaire Technologique Art","Baccalauréat Scientifique","Baccalauréat Littéraire","Licence Biologie");
        
        for($i=0;$i<12;$i++)
        {   
            $nomCourt=$listeNomCourt[$faker->numberBetween(0,count($listeNomCourt)-1)];
            $nomLong=$listeNomLong[$faker->numberBetween(0,count($listeNomLong)-1)];


            $uneFormation= new Formation();
            $uneFormation->setNomCourt($nomCourt);
            $uneFormation->setNomLong($nomLong);

            array_push($listeFormation,$uneFormation);

            $manager->persist($uneFormation);

        }
        

       
        // Gestion Entité Entreprise:

        $listeActivite=array("sportive","billard","prog web", "dev site","aviation","service","artisan");

        $listeEntreprise= array();

        for($i=1;$i<12;$i++)
        {
            $uneEntreprise=new Entreprise();

            $uneEntreprise->setNom($faker->company().$faker->companySuffix());
            $uneEntreprise->setAdresse($faker->address());
            $uneEntreprise->setActivite($listeActivite[$faker->numberBetween(0,count($listeActivite)-1)]);
            $uneEntreprise->setSiteWeb("https://".$uneEntreprise->getNom().".com");

            array_push($listeEntreprise,$uneEntreprise);

            $manager->persist($uneEntreprise);
        }


        // Gestion Entité Stage:

        $code = array("java","c","c++","sql","javascript","php","html");

        for($i=1;$i<23;$i++)
        {
            $unStage= new Stage();
            
            $stageCode=$code[$faker->numberBetween(0,count($code)-1)];
            $titre="Stage en ".$stageCode;

            $unStage->setTitre($titre);
            $unStage->setMission($faker->word); 
            $unStage->setEmail($faker->email());

            $unStage->setEntreprise($listeEntreprise[$faker->numberBetween(0,count($listeEntreprise)-1)]);

            $nombreFormation=$faker->numberBetween(1,count($listeFormation)-1);

            $unStage->addFormation($listeFormation[$nombreFormation]);

            $manager->persist($unStage);
        }

        $manager->flush();
    }
}
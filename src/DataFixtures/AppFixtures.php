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
        
        
        //
        //DECLARATION DES DIFFERENTES FORMATIONS
        //

        $formations=array();//liste compléte des formations

        $listeNomCourt = array("DUT info","DUT Design","DUT Art","Bac S","Bac L","Licence Bio");
        $listeNomLong = array("Diplôme Universitaire Technologique Informatique","Diplôme Universitaire Technologique Design","Diplôme Universitaire Technologique Art","Baccalauréat Scientifique","Baccalauréat Littéraire","Licence Biologie");
        
        for($i=0;$i<8;$i++)//on génére aléatoirement des formations
        {   
            $nomCourt=$listeNomCourt[$faker->numberBetween(0,count($listeNomCourt)-1)];
            $nomLong=$listeNomLong[$faker->numberBetween(0,count($listeNomLong)-1)];


            $uneFormation= new Formation();
            $uneFormation->setNomCourt($nomCourt);
            $uneFormation->setNomLong($nomLong);

            array_push($formations,$uneFormation);

            $manager->persist($uneFormation);

        }
        

        //
        //DECLARATIONS DES ENTREPRISES
        //
        $listeActivite=array("sportive","billard","prog web", "dev site","aviation","service","artisan");

        $entreprises= array();//liste compléte des entreprises

        for($i=1;$i<8;$i++)
        {
            $uneEntreprise=new Entreprise();

            $uneEntreprise->setNom($faker->company().$faker->companySuffix());
            $uneEntreprise->setAdresse($faker->address());
            $uneEntreprise->setActivite($listeActivite[$faker->numberBetween(0,count($listeActivite)-1)]);
            $uneEntreprise->setSiteWeb("https://".$uneEntreprise->getNom().".com");

            array_push($entreprises,$uneEntreprise);

            $manager->persist($uneEntreprise);
        }


        //
        //DECLARATION DES STAGES
        //
        $code = array("java","c","c++","sql","javascript","php","html");

        for($i=1;$i<15;$i++)//boucle de generation de stage
        {
            $unStage= new Stage();

            //Generation des variables aleatoires
            
            $stageCode=$code[$faker->numberBetween(0,count($code)-1)];
            $titre="Stage en ".$stageCode;

            $unStage->setTitre($titre);
            $unStage->setMission($faker->word); //A changer
            $unStage->setEmail($faker->email());

            $unStage->setEntreprise($entreprises[$faker->numberBetween(0,count($entreprises)-1)]);

            $nombreFormation=$faker->numberBetween(1,count($formations)-1);

            $unStage->addFormation($formations[$nombreFormation]);

            // for($j=0;$j<=$nombreFormation;$j++)//boucle d'ajout des formations
            // {
            //     $boolean="FALSE";

            //     $formationTiree=$faker->numberBetween(0,count($formations)-1);

            //     for($z=0;$z<count($formationsDejaSelectionnees);$z++)//boucle de verification des formations deja ajoutées
            //     {
            //         if($formationsDejaSelectionnees[$z]==$formationTiree)
            //         {
            //             $boolean = "TRUE";
            //         }
            //     }

            //     if($boolean=="FALSE")
            //     {
            //         array_push($formationsDejaSelectionnees,$formationTiree);
            //         $stage->addFormation($formations[$formationTiree]);
            //     }
            //     else
            //     {
            //         $y--;
            //     }

            // }

            $manager->persist($unStage);
        }

        $manager->flush();
    }
}
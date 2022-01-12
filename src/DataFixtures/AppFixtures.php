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
        $activites=array(   "Informatique orienté objet",
                            "Programmation web",
                            "Vendeur de tapis éléctroniques",
                            "Vendeur de chouchoux automatisés sur plage et balcons",
                            "Vendeur de tronconneuse roses",
                            "Vendeurs d'enfants magnétiques IA",
                            "Createurs d'animatronic",
                            "Chercheurs quantiques",
                            "Modelisation de metadonnées",
                            "Statisticiens et analystes informatique");

        $entreprises= array();//liste compléte des entreprises

        for($i=1;$i<8;$i++)
        {
            $uneEntreprise=new Entreprise();

            $uneEntreprise->setNom($faker->company().$faker->companySuffix());
            $uneEntreprise->setAdresse($faker->address());
            $uneEntreprise->setActivite($activites[$faker->numberBetween(0,count($activites)-1)]);
            $uneEntreprise->setSiteWeb("https://".$uneEntreprise->getNom().".com");

            array_push($entreprises,$uneEntreprise);

            $manager->persist($uneEntreprise);
        }


        //
        //DECLARATION DES STAGES
        //
        $metier= array("Developpeur","Programmeur","Designer","Statisticien","Analyste","Informaticien","Codeur","Concepteur");
        $language = array("C","C++","C#","JAVA","JAVASCRIPT","BASH","UML","CSS","PHP","HTML","SQL","Python","R","Fortran");
        $logiciel = array("Rstudio","Eclipse","Modelio","Visual Studio Code","Balsamiq","Code:blocks","Symfony","Spider");
        $plateforme = array("Linux","Unix","Windows");
        $periode = array("an(s)","minute(s)","heure(s)","seconde(s)","jour(s)","mois","semaine(s)");

        for($i=1;$i<75;$i++)//boucle de generation de stage
        {
            $stage= new Stage();

            //Generation des variables aleatoires
            $metierStage=$metier[$faker->numberBetween(0,count($metier)-1)];
            $languageStage=$language[$faker->numberBetween(0,count($language)-1)];
            $titreStage=$metierStage." en ".$languageStage;

            $stage->setTitre($titreStage);
            $stage->setMission($titreStage." sur le logiciel ".$logiciel[$faker->numberBetween(0,count($logiciel)-1)]." sous ".$plateforme[$faker->numberBetween(1,count($plateforme)-1)].", pour une durée de ".$faker->numberBetween(0,12)." ".$periode[$faker->numberBetween(0,count($periode)-1)]);
            $stage->setEmail($faker->email());

            $stage->setEntreprise($entreprises[$faker->numberBetween(0,count($entreprises)-1)]);

            $nbFormations=$faker->numberBetween(1,count($formations)-1);
            $formationsDejaSelectionnees = array();

            for($y=0;$y<=$nbFormations;$y++)//boucle d'ajout des formations
            {
                $boolean="FALSE";

                $formationTiree=$faker->numberBetween(0,count($formations)-1);

                for($z=0;$z<count($formationsDejaSelectionnees);$z++)//boucle de verification des formations deja ajoutées
                {
                    if($formationsDejaSelectionnees[$z]==$formationTiree)
                    {
                        $boolean = "TRUE";
                    }
                }

                if($boolean=="FALSE")
                {
                    array_push($formationsDejaSelectionnees,$formationTiree);
                    $stage->addFormation($formations[$formationTiree]);
                }
                else
                {
                    $y--;
                }

            }

            $manager->persist($stage);
        }

        $manager->flush();
    }
}

        


    
    }
}

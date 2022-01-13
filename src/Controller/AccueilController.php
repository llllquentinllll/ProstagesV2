<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Entreprise;
use App\Entity\Formation;
use App\Entity\Stage;


class AccueilController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */

     
    public function index(): Response
    {
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
        ]);
    }

     /**
     * @Route("/entreprises", name="entreprises")
     */
    public function entreprise(): Response
    {

        $liste_entreprises= $this->getDoctrine()->getRepository(Entreprise::class)->findAll();
        

        return $this->render('accueil/entreprise.html.twig', ['liste_entreprises'=>$liste_entreprises]);
    }

    /**
     * @Route("/formations", name="formations")
     */
    public function formation(): Response
    {
        return $this->render('accueil/formation.html.twig', [
            'controller_name' => 'FormationsController',
        ]);
    }

    /**
     * @Route("/stages", name="stages")
     */
    public function stage(): Response
    {
        $stages= $this->getDoctrine()->getRepository(Stage::class)->findAll();
        return $this->render('accueil/stage.html.twig', ['liste_stages'=>$stages]);
    }

    /**
     * @Route("/accueil/stages/{id_stage}", name="detailStage")
     */
    public function detailStage($id_stage): Response
    {
        $unStage= $this->getDoctrine()->getRepository(Stage::class)->find($id_stage);
        return $this->render('accueil/detailStage.html.twig', [
            'unStage'=>$unStage
        ]);
    }

    /**
     * @Route("/accueil/entreprises/{id_entreprise}", name="detailEntreprise")
     */
    public function detailEntreprise($id_entreprise): Response
    {
        $uneEntreprise= $this->getDoctrine()->getRepository(Entreprise::class)->find($id_entreprise);
        return $this->render('accueil/detailEntreprise.html.twig', [
            'uneEntreprise'=>$uneEntreprise
        ]);
    }
}
    


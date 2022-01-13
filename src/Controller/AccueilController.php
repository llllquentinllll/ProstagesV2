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
        return $this->render('accueil/entreprise.html.twig', [
            'controller_name' => 'EntreprisesController',
        ]);
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
        return $this->render('accueil/stage.html.twig', [
            'controller_name' => 'StagesController', 'liste_stages'=>$stages
        ]);
    }
}
    


<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ControllerEntrepriseController extends AbstractController
{
    /**
     * @Route("/controller/entreprise", name="controller_entreprise")
     */
    public function index(): Response
    {
        echo "<h1>Cette page affichera la liste des entreprises proposant un stage</h1>";
        return $this->render('controller_entreprise/index.html.twig', [
            'controller_name' => 'ControllerEntrepriseController',
        ]);
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StageController extends AbstractController
{
    /**
     * @Route("/stage/{id}", name="stage")
     */
    public function index($id): Response
    {
        
        return $this->render('stage/index.html.twig', [
            'controller_name' => $id,
        ]);
    }
}

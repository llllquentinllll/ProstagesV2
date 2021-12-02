<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Controller1Controller extends AbstractController
{
    /**
     * @Route("/", name="controller1")
     */
    public function index($id): Response
    {
        
        return $this->render('controller1/index.html.twig', [
        'controller_name' => 'Controller1Controller']);
    }
}

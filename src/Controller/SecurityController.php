<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


use App\Entity\Entreprise;
use App\Entity\Formation;
use App\Entity\Stage;
use App\Entity\User;


use Doctrine\Persistence\ObjectManager;



use Symfony\Component\HttpFoundation\Request;



use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Doctrine\ORM\EntityManagerInterface;
use App\Form\EntrepriseFormType;
use App\Form\StageFormType;
use App\Form\UserType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout(): void
    {
        
    }

    /**
     * @Route("/inscription", name="inscription")
     */
    public function formInscription(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder): Response
    {
        

        $utilisateur= new User();


        $formulaireUser= $this->createForm(UserType::class, $utilisateur);


        $formulaireUser->handleRequest($request);

        if( $formulaireUser->isSubmitted() && $formulaireUser->isValid())
        {
            $utilisateur->setRoles(['ROLE_USER']);

            $encodageMdp= $encoder->encodePassword($utilisateur,$utilisateur->getPassword());
            $utilisateur->setPassword($encodageMdp);

            $manager->persist($utilisateur);
            $manager->flush();

            return $this -> redirectToRoute('login');
        }
        
        return $this->render('security/inscription.html.twig', [
            'unFormulaire'=>$formulaireUser->createView()
        ]);

    }

    
}

<?php

namespace App\Controller;

use App\Form\NewsletterType;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="app_home")
     */
    public function index(Request $request, LoggerInterface $log): Response
    {
    
        // $log->error("Test de la log");
        // création du formulaire type
        $formulaire= $this->createForm(NewsletterType::class);
        
        //Lit les données envoyé via l'url
        $formulaire->handleRequest($request);

           // on vérifie si les donnée sont envoyé
           if ($formulaire->isSubmitted()){
     
            // on recuperer les donnée envoyé
            $data=$formulaire->getData();
            $mail=$data['email'];

            // on redirige vers la page envoye.html.twig
            // avec la variable data['nom']
            return $this->renderForm('home/newsletter.html.twig', [
               
                'mail' => $mail
            ]);
        }

        else {
            $nom="yoel";
            // l'envoie à la vue
            return $this->renderForm('home/index.html.twig', [
            'variable' => $nom,
            "monformulaire" => $formulaire
            ]);
        }
    }
}

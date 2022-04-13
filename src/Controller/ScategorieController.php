<?php

namespace App\Controller;

use App\Entity\Scategorie;
use App\Form\Scategorie1Type;
use App\Repository\ScategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/scategorie")
 */
class ScategorieController extends AbstractController
{
    /**
     * @Route("/", name="app_scategorie_index", methods={"GET"})
     */
    public function index(ScategorieRepository $scategorieRepository): Response
    {
        return $this->render('scategorie/index.html.twig', [
            'scategories' => $scategorieRepository->findAll(),
        ]);
    }
 
    /**
     * @Route("/{id}", name="app_scategorie_show", methods={"GET"})
     */
    public function show(Scategorie $scategorie): Response
    {
        return $this->render('scategorie/show.html.twig', [
            'scategorie' => $scategorie,
        ]);
    }
  
}

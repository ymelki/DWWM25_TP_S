<?php

namespace App\Controller;

use App\Entity\Dproduit;
use App\Form\Dproduit1Type;
use App\Repository\DproduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dproduit/catalog")
 */
class DproduitCatalogController extends AbstractController
{
    /**
     * @Route("/", name="app_dproduit_catalog_index", methods={"GET"})
     */
    public function index(DproduitRepository $dproduitRepository): Response
    {
        return $this->render('dproduit_catalog/index.html.twig', [
            'dproduits' => $dproduitRepository->findAll(),
        ]);
    }

    
    /**
     * @Route("/{id}", name="app_dproduit_catalog_show", methods={"GET"})
     */
    public function show(Dproduit $dproduit): Response
    {
        return $this->render('dproduit_catalog/show.html.twig', [
            'dproduit' => $dproduit,
        ]);
    }

    
    
}

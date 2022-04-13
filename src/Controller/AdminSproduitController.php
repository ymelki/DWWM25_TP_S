<?php

namespace App\Controller;

use App\Entity\Sproduit;
use App\Form\SproduitType;
use App\Repository\SproduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/sproduit")
 */
class AdminSproduitController extends AbstractController
{

    /**
     * @Route("/cat_prod/{id}", name="app_admin_prod_cat", methods={"GET"})
     */
    public function prod_cat(SproduitRepository $sproduitRepository, Sproduit $sproduit): Response
    {
      
        return $this->render('admin_sproduit/index.html.twig', [
            'sproduits' => $sproduitRepository->findby(['id' => $sproduit->getId()]),
        ]);
    }


    /**
     * @Route("/", name="app_admin_sproduit_index", methods={"GET"})
     */
    public function index(SproduitRepository $sproduitRepository): Response
    {
        return $this->render('admin_sproduit/index.html.twig', [
            'sproduits' => $sproduitRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_admin_sproduit_new", methods={"GET", "POST"})
     */
    public function new(Request $request, SproduitRepository $sproduitRepository): Response
    {
        $sproduit = new Sproduit();
        $form = $this->createForm(SproduitType::class, $sproduit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sproduitRepository->add($sproduit);
            return $this->redirectToRoute('app_admin_sproduit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_sproduit/new.html.twig', [
            'sproduit' => $sproduit,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_admin_sproduit_show", methods={"GET"})
     */
    public function show(Sproduit $sproduit): Response
    {
        return $this->render('admin_sproduit/show.html.twig', [
            'sproduit' => $sproduit,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_admin_sproduit_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Sproduit $sproduit, SproduitRepository $sproduitRepository): Response
    {
        $form = $this->createForm(SproduitType::class, $sproduit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sproduitRepository->add($sproduit);
            return $this->redirectToRoute('app_admin_sproduit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_sproduit/edit.html.twig', [
            'sproduit' => $sproduit,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_admin_sproduit_delete", methods={"POST"})
     */
    public function delete(Request $request, Sproduit $sproduit, SproduitRepository $sproduitRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sproduit->getId(), $request->request->get('_token'))) {
            $sproduitRepository->remove($sproduit);
        }

        return $this->redirectToRoute('app_admin_sproduit_index', [], Response::HTTP_SEE_OTHER);
    }
}

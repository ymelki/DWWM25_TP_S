<?php

namespace App\Controller;

use App\Entity\Dproduit;
use App\Form\DproduitType;
use App\Service\FileUploader;
use App\Repository\DproduitRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/dproduit")
 */
class AdminDproduitController extends AbstractController
{
    /**
     * @Route("/", name="app_admin_dproduit_index", methods={"GET"})
     */
    public function index(DproduitRepository $dproduitRepository): Response
    {
        return $this->render('admin_dproduit/index.html.twig', [
            'dproduits' => $dproduitRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_admin_dproduit_new", methods={"GET", "POST"})
     */
    public function new(FileUploader  $fileUploader , Request $request, DproduitRepository $dproduitRepository): Response
    {
        $dproduit = new Dproduit();
        $form = $this->createForm(DproduitType::class, $dproduit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

                // le fichier qu'on recupere depuis le form
                $file = $form->get('image')->getData();
                // Si il existe bien alors
                if ($file) {
                    // on l'envoie sur le serveur grace au service
                    $FileName = $fileUploader->upload($file); // upload du fichier
                    $dproduit->setImagefilename($FileName); // nom du fichier
                }



            $dproduitRepository->add($dproduit);
            return $this->redirectToRoute('app_admin_dproduit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_dproduit/new.html.twig', [
            'dproduit' => $dproduit,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_admin_dproduit_show", methods={"GET"})
     */
    public function show(Dproduit $dproduit): Response
    {
        return $this->render('admin_dproduit/show.html.twig', [
            'dproduit' => $dproduit,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_admin_dproduit_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Dproduit $dproduit, DproduitRepository $dproduitRepository): Response
    {
        $form = $this->createForm(DproduitType::class, $dproduit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dproduitRepository->add($dproduit);
            return $this->redirectToRoute('app_admin_dproduit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_dproduit/edit.html.twig', [
            'dproduit' => $dproduit,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_admin_dproduit_delete", methods={"POST"})
     */
    public function delete(Request $request, Dproduit $dproduit, DproduitRepository $dproduitRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dproduit->getId(), $request->request->get('_token'))) {
            $dproduitRepository->remove($dproduit);
        }

        return $this->redirectToRoute('app_admin_dproduit_index', [], Response::HTTP_SEE_OTHER);
    }
}

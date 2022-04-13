<?php

namespace App\Controller;

use App\Entity\Warticle;
use App\Form\WarticleType;
use App\Repository\WarticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/warticle")
 */
class WarticleController extends AbstractController
{
    /**
     * @Route("/", name="app_warticle_index", methods={"GET"})
     */
    public function index(WarticleRepository $warticleRepository): Response
    {
        return $this->render('warticle/index.html.twig', [
            'warticles' => $warticleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_warticle_new", methods={"GET", "POST"})
     */
    public function new(Request $request, WarticleRepository $warticleRepository): Response
    {
        $warticle = new Warticle();
        $form = $this->createForm(WarticleType::class, $warticle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $warticleRepository->add($warticle);
            return $this->redirectToRoute('app_warticle_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('warticle/new.html.twig', [
            'warticle' => $warticle,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_warticle_show", methods={"GET"})
     */
    public function show(Warticle $warticle): Response
    {
        return $this->render('warticle/show.html.twig', [
            'warticle' => $warticle,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_warticle_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Warticle $warticle, WarticleRepository $warticleRepository): Response
    {
        $form = $this->createForm(WarticleType::class, $warticle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $warticleRepository->add($warticle);
            return $this->redirectToRoute('app_warticle_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('warticle/edit.html.twig', [
            'warticle' => $warticle,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_warticle_delete", methods={"POST"})
     */
    public function delete(Request $request, Warticle $warticle, WarticleRepository $warticleRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$warticle->getId(), $request->request->get('_token'))) {
            $warticleRepository->remove($warticle);
        }

        return $this->redirectToRoute('app_warticle_index', [], Response::HTTP_SEE_OTHER);
    }
}

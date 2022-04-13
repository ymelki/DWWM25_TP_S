<?php

namespace App\Controller;

use App\Entity\Wcategorie;
use App\Form\WcategorieType;
use App\Repository\WcategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/wcategorie")
 */
class WcategorieController extends AbstractController
{
    /**
     * @Route("/", name="app_wcategorie_index", methods={"GET"})
     */
    public function index(WcategorieRepository $wcategorieRepository): Response
    {
        return $this->render('wcategorie/index.html.twig', [
            'wcategories' => $wcategorieRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_wcategorie_new", methods={"GET", "POST"})
     */
    public function new(Request $request, WcategorieRepository $wcategorieRepository): Response
    {
        $wcategorie = new Wcategorie();
        $form = $this->createForm(WcategorieType::class, $wcategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $wcategorieRepository->add($wcategorie);
            return $this->redirectToRoute('app_wcategorie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('wcategorie/new.html.twig', [
            'wcategorie' => $wcategorie,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_wcategorie_show", methods={"GET"})
     */
    public function show(Wcategorie $wcategorie): Response
    {
        return $this->render('wcategorie/show.html.twig', [
            'wcategorie' => $wcategorie,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_wcategorie_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Wcategorie $wcategorie, WcategorieRepository $wcategorieRepository): Response
    {
        $form = $this->createForm(WcategorieType::class, $wcategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $wcategorieRepository->add($wcategorie);
            return $this->redirectToRoute('app_wcategorie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('wcategorie/edit.html.twig', [
            'wcategorie' => $wcategorie,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_wcategorie_delete", methods={"POST"})
     */
    public function delete(Request $request, Wcategorie $wcategorie, WcategorieRepository $wcategorieRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$wcategorie->getId(), $request->request->get('_token'))) {
            $wcategorieRepository->remove($wcategorie);
        }

        return $this->redirectToRoute('app_wcategorie_index', [], Response::HTTP_SEE_OTHER);
    }

}

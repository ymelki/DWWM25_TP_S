<?php

namespace App\Controller;

use App\Entity\Dcategorie;
use App\Form\DcategorieType;
use App\Repository\DcategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dcategorie")
 */
class DcategorieController extends AbstractController
{
    /**
     * @Route("/", name="app_dcategorie_index", methods={"GET"})
     */
    public function index(DcategorieRepository $dcategorieRepository): Response
    {
        return $this->render('dcategorie/index.html.twig', [
            'dcategories' => $dcategorieRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_dcategorie_new", methods={"GET", "POST"})
     */
    public function new(Request $request, DcategorieRepository $dcategorieRepository): Response
    {
        $dcategorie = new Dcategorie();
        $form = $this->createForm(DcategorieType::class, $dcategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dcategorieRepository->add($dcategorie);
            return $this->redirectToRoute('app_dcategorie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dcategorie/new.html.twig', [
            'dcategorie' => $dcategorie,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_dcategorie_show", methods={"GET"})
     */
    public function show(Dcategorie $dcategorie): Response
    {
        return $this->render('dcategorie/show.html.twig', [
            'dcategorie' => $dcategorie,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_dcategorie_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Dcategorie $dcategorie, DcategorieRepository $dcategorieRepository): Response
    {
        $form = $this->createForm(DcategorieType::class, $dcategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dcategorieRepository->add($dcategorie);
            return $this->redirectToRoute('app_dcategorie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dcategorie/edit.html.twig', [
            'dcategorie' => $dcategorie,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_dcategorie_delete", methods={"POST"})
     */
    public function delete(Request $request, Dcategorie $dcategorie, DcategorieRepository $dcategorieRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dcategorie->getId(), $request->request->get('_token'))) {
            $dcategorieRepository->remove($dcategorie);
        }

        return $this->redirectToRoute('app_dcategorie_index', [], Response::HTTP_SEE_OTHER);
    }
}

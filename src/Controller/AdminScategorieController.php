<?php

namespace App\Controller;

use App\Entity\Scategorie;
use App\Form\ScategorieType;
use App\Repository\ScategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/scategorie")
 */
class AdminScategorieController extends AbstractController
{



    
        /**
     * @Route("/test", name="app_admin_index_test", methods={"GET"})
     */
    public function index_test(ScategorieRepository $scategorieRepository): Response
    {
        return $this->render('admin_scategorie/index.html.twig', [
            'scategories' => $scategorieRepository->findAll(),
        ]);
    }


    /**
     * @Route("/", name="app_admin_scategorie_index", methods={"GET"})
     */
    public function index(ScategorieRepository $scategorieRepository): Response
    {
        return $this->render('admin_scategorie/index.html.twig', [
            'scategories' => $scategorieRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_admin_scategorie_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ScategorieRepository $scategorieRepository): Response
    {
        $scategorie = new Scategorie();
        $form = $this->createForm(ScategorieType::class, $scategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $scategorieRepository->add($scategorie);
            return $this->redirectToRoute('app_admin_scategorie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_scategorie/new.html.twig', [
            'scategorie' => $scategorie,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_admin_scategorie_show", methods={"GET"})
     */
    public function show(Scategorie $scategorie): Response
    {
        return $this->render('admin_scategorie/show.html.twig', [
            'scategorie' => $scategorie,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_admin_scategorie_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Scategorie $scategorie, ScategorieRepository $scategorieRepository): Response
    {
        $form = $this->createForm(ScategorieType::class, $scategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $scategorieRepository->add($scategorie);
            return $this->redirectToRoute('app_admin_scategorie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_scategorie/edit.html.twig', [
            'scategorie' => $scategorie,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_admin_scategorie_delete", methods={"POST"})
     */
    public function delete(Request $request, Scategorie $scategorie, ScategorieRepository $scategorieRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$scategorie->getId(), $request->request->get('_token'))) {
            $scategorieRepository->remove($scategorie);
        }

        return $this->redirectToRoute('app_admin_scategorie_index', [], Response::HTTP_SEE_OTHER);
    }
}

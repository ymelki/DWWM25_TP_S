<?php

namespace App\Controller;

use App\Entity\ProfileCategorie;
use App\Form\ProfileCategorieType;
use App\Repository\ProfileCategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/profile/categorie")
 */
class ProfileCategorieController extends AbstractController
{
    /**
     * @Route("/", name="app_profile_categorie_index", methods={"GET"})
     */
    public function index(ProfileCategorieRepository $profileCategorieRepository): Response
    {
        return $this->render('profile_categorie/index.html.twig', [
            'profile_categories' => $profileCategorieRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_profile_categorie_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ProfileCategorieRepository $profileCategorieRepository): Response
    {
        $profileCategorie = new ProfileCategorie();
        $form = $this->createForm(ProfileCategorieType::class, $profileCategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $profileCategorieRepository->add($profileCategorie);
            return $this->redirectToRoute('app_profile_categorie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('profile_categorie/new.html.twig', [
            'profile_categorie' => $profileCategorie,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_profile_categorie_show", methods={"GET"})
     */
    public function show(ProfileCategorie $profileCategorie): Response
    {
        return $this->render('profile_categorie/show.html.twig', [
            'profile_categorie' => $profileCategorie,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_profile_categorie_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, ProfileCategorie $profileCategorie, ProfileCategorieRepository $profileCategorieRepository): Response
    {
        $form = $this->createForm(ProfileCategorieType::class, $profileCategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $profileCategorieRepository->add($profileCategorie);
            return $this->redirectToRoute('app_profile_categorie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('profile_categorie/edit.html.twig', [
            'profile_categorie' => $profileCategorie,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_profile_categorie_delete", methods={"POST"})
     */
    public function delete(Request $request, ProfileCategorie $profileCategorie, ProfileCategorieRepository $profileCategorieRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$profileCategorie->getId(), $request->request->get('_token'))) {
            $profileCategorieRepository->remove($profileCategorie);
        }

        return $this->redirectToRoute('app_profile_categorie_index', [], Response::HTTP_SEE_OTHER);
    }
}

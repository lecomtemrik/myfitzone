<?php

namespace App\Controller\Redacteur;

use App\Entity\IngredientRecette;
use App\Form\IngredientRecetteType;
use App\Repository\IngredientRecetteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ingredientrecette")
 */
class IngredientRecetteController extends AbstractController
{
    /**
     * @Route("/", name="ingredient_recette_index", methods={"GET"})
     */
    public function index(IngredientRecetteRepository $ingredientRecetteRepository): Response
    {
        return $this->render('redacteur/ingredient_recette/index.html.twig', [
            'ingredient_recettes' => $ingredientRecetteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="ingredient_recette_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ingredientRecette = new IngredientRecette();
        $form = $this->createForm(IngredientRecetteType::class, $ingredientRecette);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ingredientRecette);
            $entityManager->flush();

            return $this->redirectToRoute('ingredient_recette_index');
        }

        return $this->render('redacteur/ingredient_recette/new.html.twig', [
            'ingredient_recette' => $ingredientRecette,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ingredient_recette_show", methods={"GET"})
     */
    public function show(IngredientRecette $ingredientRecette): Response
    {
        return $this->render('redacteur/ingredient_recette/show.html.twig', [
            'ingredient_recette' => $ingredientRecette,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ingredient_recette_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, IngredientRecette $ingredientRecette): Response
    {
        $form = $this->createForm(IngredientRecetteType::class, $ingredientRecette);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ingredient_recette_index');
        }

        return $this->render('redacteur/ingredient_recette/edit.html.twig', [
            'ingredient_recette' => $ingredientRecette,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ingredient_recette_delete", methods={"DELETE"})
     */
    public function delete(Request $request, IngredientRecette $ingredientRecette): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ingredientRecette->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ingredientRecette);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ingredient_recette_index');
    }
}

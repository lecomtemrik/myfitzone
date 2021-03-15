<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\Recette;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/recette")
 */
class TemplateRecetteController extends AbstractController
{
    /**
     * @Route("/{slug}", name="recette", methods={"GET"})
     */
    public function recetteTemplate(Recette $recette): Response
    {
        return $this->render('models/recette-template.html.twig', [
            'recette' => $recette,
        ]);
    }
}

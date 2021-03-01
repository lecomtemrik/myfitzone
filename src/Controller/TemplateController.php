<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Categorie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/article")
 */
class TemplateController extends AbstractController
{

    /**
     * @Route("/{slug}", name="article", methods={"GET"})
     */
    public function articleTemplate(Article $article): Response
    {
        return $this->render('models/article-template.html.twig', [
            'article' => $article,
        ]);
    }
}

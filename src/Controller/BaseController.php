<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\CategorieRepository;
use App\Repository\RecetteRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;


class BaseController extends AbstractController
{

    /**
     * @Route("/", name="home")
     */
    public function index(ArticleRepository $articleRepository, CategorieRepository $categorieRepository, RecetteRepository $recetteRepository):Response
    {
        $session = new Session();
        $session->clear();
        $session->set('articles', $articleRepository->findAll());
        $session->set('categories', $categorieRepository->findAll());
        $session->set('recettes', $recetteRepository->findAll());
        return $this->render('base.html.twig');
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function admin()
    {
        return $this->render('admin/admin.html.twig');
    }

}

<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Entity\Profil;
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

        $utilisateur = $this->getUser();
        if ($utilisateur){
            if ($utilisateur->getAdresse() == null){
                $adresse = new Adresse();
                $adresse->setUtilisateur($utilisateur);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($utilisateur);
                $entityManager->flush();
            }
            if ($utilisateur->getProfil() == null ){
                $profil = new Profil();
                $profil->setUtilisateur($utilisateur);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($profil);
                $entityManager->flush();

            }
        }

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

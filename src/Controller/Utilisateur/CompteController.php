<?php

namespace App\Controller\Utilisateur;

use App\Repository\UtilisateurRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class CompteController extends AbstractController
{

    /**
     * @Route("/compte", name="compte")
     */
    public function index(UtilisateurRepository $utilisateurRepository):Response
    {
        return $this->render('utilisateur/compte/index.html.twig', [
            'utilisateurs'=> $utilisateurRepository->findAll(),
        ]);
    }

}

<?php

namespace App\Controller;

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
        return $this->render('compte/index.html.twig', [
            'utilisateurs'=> $utilisateurRepository->findAll(),
        ]);
    }

}

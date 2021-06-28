<?php

namespace App\Controller\Utilisateur;

use App\Repository\BadgeRepository;
use App\Repository\UtilisateurRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class CompteController extends AbstractController
{

    /**
     * @Route("/compte", name="compte")
     */
    public function index(UtilisateurRepository $utilisateurRepository, BadgeRepository $badgeRepository):Response
    {
        $userId = $this->getUser()->getID();

        $badgeUser = $badgeRepository->findBy(['utilisateur'=>$this->getUser()->getId()]);
        $badge = $badgeUser[0];

        if (!$badge->getBienvenue()){
            $entityManager = $this->getDoctrine()->getManager();
            $badge->setBienvenue(true);
            $entityManager->persist($badge);
            $entityManager->flush();
        }

        return $this->render('utilisateur/compte/index.html.twig', [
            'utilisateurs'=> $utilisateurRepository->findAll(),
            'badges'=>$badgeRepository->findBy(['utilisateur'=>$userId]),
        ]);
    }

}

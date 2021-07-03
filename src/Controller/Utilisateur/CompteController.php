<?php

namespace App\Controller\Utilisateur;

use App\Entity\Utilisateur;
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
        $totalUser = $utilisateurRepository->totalCount();

        if (!$badge->getBienvenue()){
            $entityManager = $this->getDoctrine()->getManager();
            if ($totalUser < 10000){
                $badge->setPionnier(true);
            }
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

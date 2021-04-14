<?php

namespace App\Controller\Outils;

use App\Entity\Mesure;
use App\Form\MesureType;
use App\Repository\MesureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/indicateur")
 */
class IndicateurController extends AbstractController
{

    /**
     * @Route("/", name="indicateur_index", methods={"GET","POST"})
     */
    public function new(Request $request, MesureRepository $mesureRepository): Response
    {
        $mesure = new Mesure();
        $utilisateur = $this->getUser();
        $mesureUtilisateur = $mesureRepository->findBy(['utilisateur'=>$utilisateur->getId()]);
        $lastMesure = end($mesureUtilisateur);
        $form = $this->createForm(MesureType::class, $mesure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $mesure->setUtilisateur($utilisateur);
            $entityManager->persist($mesure);
            $entityManager->flush();

            return $this->redirectToRoute('indicateur_index');
        }

        return $this->render('outils/indicateur.html.twig', [
            'mesures' => $mesureUtilisateur,
            'lastMesure' => $lastMesure,
            'form' => $form->createView(),
        ]);
    }


}

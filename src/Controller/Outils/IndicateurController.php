<?php

namespace App\Controller\Outils;

use App\Entity\Mesure;
use App\Form\MesureType;
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
    public function new(Request $request): Response
    {
        $mesure = new Mesure();
        $utilisateur = $this->getUser();
        $form = $this->createForm(MesureType::class, $mesure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $mesure->setUtilisateur($utilisateur);
            $entityManager->persist($mesure);
            $entityManager->flush();

            return $this->redirectToRoute('adresse_index');
        }

        return $this->render('outils/indicateur.html.twig', [
            'mesure' => $mesure,
            'form' => $form->createView(),
        ]);
    }


}

<?php

namespace App\Controller\Outils;

use App\Entity\Mensuration;
use App\Form\MensurationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/mensuration")
 */
class MensurationController extends AbstractController
{


    /**
     * @Route("/", name="mensuration_index", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $mensuration = new Mensuration();
        $utilisateur = $this->getUser();
        $form = $this->createForm(MensurationType::class, $mensuration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $mensuration->setUtilisateur($utilisateur);
            $entityManager->persist($mensuration);
            $entityManager->flush();

            return $this->redirectToRoute('adresse_index');
        }

        return $this->render('outils/mensuration.html.twig', [
            'mensuration' => $mensuration,
            'form' => $form->createView(),
        ]);
    }


}

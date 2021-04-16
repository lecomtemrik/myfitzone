<?php

namespace App\Controller\Outils;

use App\Entity\Mensuration;
use App\Form\MensurationType;
use App\Repository\MensurationRepository;
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
    public function new(Request $request, MensurationRepository $mensurationRepository): Response
    {
        $mensuration = new Mensuration();
        $utilisateur = $this->getUser();
        $mensurationUtilisateur = $mensurationRepository->findBy(['utilisateur'=>$utilisateur->getId()]);
        $lastMensuration = end($mensurationUtilisateur);

        foreach ($mensurationUtilisateur as $item){
            $mensurationArray[] = $item->getBras();
        }

        $brasArr =  array_values($mensurationArray);

        $form = $this->createForm(MensurationType::class, $mensuration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $mensuration->setUtilisateur($utilisateur);
            $entityManager->persist($mensuration);
            $entityManager->flush();
            dump($brasArr);

            return $this->redirectToRoute('mensuration_index');
        }

        return $this->render('outils/mensuration.html.twig', [
            'mensurations' => $mensurationArray,
            'mensurationArr' => $brasArr,
            'lastMensuration' => $lastMensuration,
            'form' => $form->createView(),
        ]);
    }


}

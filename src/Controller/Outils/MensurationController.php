<?php

namespace App\Controller\Outils;

use App\Entity\Mensuration;
use App\Entity\MensurationObjectif;
use App\Form\MensurationObjectifType;
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
        $mensurationObjectif = new MensurationObjectif();
        $utilisateur = $this->getUser();
        $mensurationUtilisateur = $mensurationRepository->findBy(['utilisateur'=>$utilisateur->getId()]);
        $lastMensuration = end($mensurationUtilisateur);

        foreach ($mensurationUtilisateur as $item){
            $mensurationArray[] = $item->getBras();
        }

        $brasArr =  array_values($mensurationArray);

        $formActuel = $this->createForm(MensurationType::class, $mensuration);
        $formObjectif = $this->createForm(MensurationObjectifType::class, $mensurationObjectif);
        $formActuel->handleRequest($request);
        $formObjectif->handleRequest($request);

        if ($formActuel->isSubmitted() && $formActuel->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $mensuration->setUtilisateur($utilisateur);
            $entityManager->persist($mensuration);
            $entityManager->flush();

            return $this->redirectToRoute('mensuration_index');
        }

        if ($formObjectif->isSubmitted() && $formObjectif->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $mensurationObjectif->setUtilisateur($utilisateur);
            $entityManager->persist($mensurationObjectif);
            $entityManager->flush();

            return $this->redirectToRoute('mensuration_index');
        }

        return $this->render('outils/mensuration.html.twig', [
            'mensurations' => $mensurationArray,
            'mensurationArr' => $brasArr,
            'lastMensuration' => $lastMensuration,
            'formActuel' => $formActuel->createView(),
            'formObjectif' => $formObjectif->createView(),
        ]);
    }


}

<?php

namespace App\Controller\Outils;

use App\Entity\Mensuration;
use App\Entity\MensurationObjectif;
use App\Form\MensurationObjectifType;
use App\Form\MensurationType;
use App\Repository\MensurationObjectifRepository;
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
    public function new(Request $request, MensurationRepository $mensurationRepository, MensurationObjectifRepository $mensurationObjectifRepository): Response
    {
        $mensuration = new Mensuration();
        $mensurationObjectif = new MensurationObjectif();
        $utilisateur = $this->getUser();

        $mensurationArray = null;
        $lastMensuration = null;
        $lastMensurationObjectif = null;

        $couArrayValues = null;
        $epaulesArrayValues = null;
        $poitrineArrayValues = null;
        $brasArrayValues = null;

        $mensurationUtilisateur = $mensurationRepository->findBy(['utilisateur'=>$utilisateur->getId()]);
        $mensurationObjectifUtilisateur = $mensurationObjectifRepository->findBy(['utilisateur'=>$utilisateur->getId()]);

        //traitement de date
        foreach ($mensurationUtilisateur as $item){
            $dateTimeArray[] = $item->getDate();
        }
        foreach ($dateTimeArray as $date){
            $dateArray[] = $date->format('d-m-Y');
        }
        $dateArrayValues =  array_values($dateArray);

        if (empty($mensurationUtilisateur and $mensurationObjectifUtilisateur)){
            $mensurationUtilisateur = null;
            $mensurationObjectifUtilisateur = null;
        }else  {
            $lastMensuration = end($mensurationUtilisateur);
            $lastMensurationObjectif = end($mensurationObjectifUtilisateur);
            foreach ($mensurationUtilisateur as $item){
                $couArray[] = $item->getCou();
                $epaulesArray[] = $item->getEpaules();
                $poitrineArray[] = $item->getPoitrine();
                $brasArray[] = $item->getBras();
            }
            $couArrayValues =  array_values($couArray);
            $epaulesArrayValues =  array_values($epaulesArray);
            $poitrineArrayValues =  array_values($poitrineArray);
            $brasArrayValues =  array_values($brasArray);
        }

        $formActuel = $this->createForm(MensurationType::class, $mensuration);
        $formObjectif = $this->createForm(MensurationObjectifType::class, $mensurationObjectif);
        $formActuel->handleRequest($request);
        $formObjectif->handleRequest($request);

        if ($formActuel->isSubmitted() && $formActuel->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $mensuration->setUtilisateur($utilisateur);
            $mensuration->setDate(new \DateTime('now'));
            $entityManager->persist($mensuration);
            $entityManager->flush();

            return $this->redirectToRoute('mensuration_index');
        }

        if ($formObjectif->isSubmitted() && $formObjectif->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $mensurationObjectif->setUtilisateur($utilisateur);
            $mensurationObjectif->setDate(new \DateTime('now'));
            $entityManager->persist($mensurationObjectif);
            $entityManager->flush();

            return $this->redirectToRoute('mensuration_index');
        }
        return $this->render('outils/mensuration.html.twig', [
            'mensurations' => $mensurationArray,
            'lastMensuration' => $lastMensuration,
            'lastMensurationObjectif' => $lastMensurationObjectif,

            'formActuel' => $formActuel->createView(),
            'formObjectif' => $formObjectif->createView(),

            'cou' => $couArrayValues,
            'epaules' => $epaulesArrayValues,
            'poitrine' => $poitrineArrayValues,
            'bras' => $brasArrayValues,
            'date' => $dateArrayValues,

        ]);
    }


}

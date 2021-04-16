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
        $form = $this->createForm(MesureType::class, $mesure);
        $form->handleRequest($request);

        $utilisateur = $this->getUser();
        $mesureUtilisateur = $mesureRepository->findBy(['utilisateur'=>$utilisateur->getId()]);

        if (empty($mesureUtilisateur)){
            $imcResult = null;
            $imgResult = null;
        }else{
            $lastMesure = end($mesureUtilisateur);

            $imcResult = round($lastMesure->getPoids()/pow($lastMesure->getTaille()/100, 2),1);
            if ($lastMesure->getSexe()==true){
                $imgResult = round((1.2*$imcResult)+(0.23*$lastMesure->getAge())-(10.8*1)-5.4,1);
            }else {
                $imgResult = round((1.2*$imcResult)+(0.23*$lastMesure->getAge())-(10.8*0)-5.4,1);
            }
        }

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $mesure->setUtilisateur($utilisateur);
            $entityManager->persist($mesure);
            $entityManager->flush();

            return $this->redirectToRoute('indicateur_index');
        }

        return $this->render('outils/indicateur.html.twig', [
            'imc' => $imcResult,
            'img' => $imgResult,
            'mesures' => $mesureUtilisateur,
//            'lastMesure' => $lastMesure,
            'form' => $form->createView(),
        ]);
    }


}

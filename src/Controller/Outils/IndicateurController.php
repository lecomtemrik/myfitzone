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
            $metaBase = null;
            $poidsIdeal = null;
            $quantiteEau = null;
            $besoinCalorique = null;
        }else{
            $lastMesure = end($mesureUtilisateur);
            $imcResult = round($lastMesure->getPoids()/pow($lastMesure->getTaille()/100, 2),1);
            if ($lastMesure->getAge() < 60){
                $quantiteEau = round($lastMesure->getPoids()*30);
            }else {
                $quantiteEau = round($lastMesure->getPoids()*25);
            }

            if ($lastMesure->getSexe()==true){
                $imgResult = round((1.2*$imcResult)+(0.23*$lastMesure->getAge())-(10.8*1)-5.4,1);
                $metaBase = round(66.5+(13.75*$lastMesure->getPoids())+(5*$lastMesure->getTaille())-(6.77*$lastMesure->getAge()));
                $poidsIdeal = round($lastMesure->getTaille()-100-(($lastMesure->getTaille()-150)/4));
            }else {
                $imgResult = round((1.2*$imcResult)+(0.23*$lastMesure->getAge())-(10.8*0)-5.4,1);
                $metaBase = round(655+(9.56*$lastMesure->getPoids())+(1.85*$lastMesure->getTaille())-(4.67*$lastMesure->getAge()));
                $poidsIdeal = round($lastMesure->getTaille()-100-(($lastMesure->getTaille()-150)/2.5));
            }

            if ($lastMesure->getNiveauActivite() == 'sedentaire'){
                $besoinCalorique = round($metaBase*1.37,1);
            }elseif ($lastMesure->getNiveauActivite() == 'actif'){
                $besoinCalorique = round($metaBase*1.55,1);
            }elseif ($lastMesure->getNiveauActivite() == 'sportif'){
                $besoinCalorique = round($metaBase*1.80,1);
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
            'metabolismeBase' => $metaBase,
            'besoinCalorique' => $besoinCalorique,
            'poidsIdeal' => $poidsIdeal,
            'quantiteEau' => $quantiteEau,
            'mesures' => $mesureUtilisateur,
            'form' => $form->createView(),
        ]);
    }


}

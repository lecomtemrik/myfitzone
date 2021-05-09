<?php

namespace App\Controller\Outils;

use App\Entity\Mesure;
use App\Form\MesureType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/calculatrices")
 */
class OutilsController extends AbstractController
{
    /**
     * @Route("/imc", name="imc", methods={"GET","POST"})
     */
    public function imcCalcul(Request $request): Response
    {

        $mesure = new Mesure();
        $imcResult = null;
        $form = $this->createForm(MesureType::class, $mesure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imcResult = round($mesure->getPoids()/pow($mesure->getTaille()/100, 2),1);

            return $this->render('outils/calculatrice_imc.html.twig', [
                'imc' => $imcResult,
                'form' => $form->createView(),
            ]);
        }

        return $this->render('outils/calculatrice_imc.html.twig', [
            'imc' => null,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/img", name="img", methods={"GET","POST"})
     */
    public function imgCalcul(Request $request): Response
    {

        $mesure = new Mesure();
        $imgResult = null;
        $form = $this->createForm(MesureType::class, $mesure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imcResult = round($mesure->getPoids()/pow($mesure->getTaille()/100, 2),1);

            if ($mesure->getSexe()==true){
                $imgResult = round((1.2*$imcResult)+(0.23*$mesure->getAge())-(10.8*1)-5.4,1);
            }else {
                $imgResult = round((1.2*$imcResult)+(0.23*$mesure->getAge())-(10.8*0)-5.4,1);
            }

            return $this->render('outils/calculatrice_img.html.twig', [
                'img' => $imgResult,
                'form' => $form->createView(),
            ]);
        }

        return $this->render('outils/calculatrice_img.html.twig', [
            'img' => null,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/poids-ideal", name="poidsIdeal", methods={"GET","POST"})
     */
    public function piCalcul(Request $request): Response
    {

        $mesure = new Mesure();
        $form = $this->createForm(MesureType::class, $mesure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($mesure->getSexe()==true){
                $poidsIdeal = round($mesure->getTaille()-100-(($mesure->getTaille()-150)/4));
            }else {
                $poidsIdeal = round($mesure->getTaille()-100-(($mesure->getTaille()-150)/2.5));
            }

            return $this->render('outils/calculatrice_poids_ideal.html.twig', [
                'poidsIdeal' => $poidsIdeal,
                'form' => $form->createView(),
            ]);
        }

        return $this->render('outils/calculatrice_poids_ideal.html.twig', [
            'poidsIdeal' => null,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/calories-par-jour", name="caloriesJour", methods={"GET","POST"})
     */
    public function caloriesJourCalcul(Request $request): Response
    {

        $mesure = new Mesure();
        $metaBase = null;
        $besoinCalorique = null;
        $form = $this->createForm(MesureType::class, $mesure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($mesure->getSexe()==true){
                $metaBase = round(66.5+(13.75*$mesure->getPoids())+(5*$mesure->getTaille())-(6.77*$mesure->getAge()));
            }else {
                $metaBase = round(655+(9.56*$mesure->getPoids())+(1.85*$mesure->getTaille())-(4.67*$mesure->getAge()));
            }

            if ($mesure->getNiveauActivite() == 'sedentaire'){
                $besoinCalorique = round($metaBase*1.37,1);
            }elseif ($mesure->getNiveauActivite() == 'actif'){
                $besoinCalorique = round($metaBase*1.55,1);
            }elseif ($mesure->getNiveauActivite() == 'sportif'){
                $besoinCalorique = round($metaBase*1.80,1);
            }

            return $this->render('outils/calculatrice_calories_jour.html.twig', [
                'metabolismeBase' => $metaBase,
                'besoinCalorique' => $besoinCalorique,
                'form' => $form->createView(),
            ]);
        }

        return $this->render('outils/calculatrice_calories_jour.html.twig', [
            'metabolismeBase' => $metaBase,
            'besoinCalorique' => $besoinCalorique,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/calories-par-jour-par-repas", name="caloriesJourRepas", methods={"GET","POST"})
     */
    public function caloriesJourRepasCalcul(Request $request): Response
    {

        $mesure = new Mesure();
        $metaBase = null;
        $besoinCalorique = null;
        $form = $this->createForm(MesureType::class, $mesure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($mesure->getSexe()==true){
                $metaBase = round(66.5+(13.75*$mesure->getPoids())+(5*$mesure->getTaille())-(6.77*$mesure->getAge()));
            }else {
                $metaBase = round(655+(9.56*$mesure->getPoids())+(1.85*$mesure->getTaille())-(4.67*$mesure->getAge()));
            }

            if ($mesure->getNiveauActivite() == 'sedentaire'){
                $besoinCalorique = round($metaBase*1.37,1);
            }elseif ($mesure->getNiveauActivite() == 'actif'){
                $besoinCalorique = round($metaBase*1.55,1);
            }elseif ($mesure->getNiveauActivite() == 'sportif'){
                $besoinCalorique = round($metaBase*1.80,1);
            }

            return $this->render('outils/calculatrice_calories_jour_repas.html.twig', [
                'besoinCalorique' => $besoinCalorique,
                'form' => $form->createView(),
            ]);
        }

        return $this->render('outils/calculatrice_calories_jour_repas.html.twig', [
            'besoinCalorique' => $besoinCalorique,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/hydratation-quotidienne", name="hydratation", methods={"GET","POST"})
     */
    public function qtEau(Request $request): Response
    {

        $mesure = new Mesure();
        $quantiteEau = null;
        $form = $this->createForm(MesureType::class, $mesure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($mesure->getAge() < 60){
                $quantiteEau = round($mesure->getPoids()*30);
            }else {
                $quantiteEau = round($mesure->getPoids()*25);
            }

            return $this->render('outils/calculatrice_hydratation.html.twig', [
                'quantiteEau' => $quantiteEau,
                'form' => $form->createView(),
            ]);
        }

        return $this->render('outils/calculatrice_hydratation.html.twig', [
            'quantiteEau' => $quantiteEau,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/body-visualizer", name="bodyVisualizer", methods={"GET","POST"})
     */
    public function bodyVisualizer(): Response
    {

        return $this->render('outils/body_visualizer.html.twig');
    }

}

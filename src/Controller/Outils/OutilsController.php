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

}

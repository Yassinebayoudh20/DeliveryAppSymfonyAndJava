<?php

namespace GroupBundle\Controller;

use GroupBundle\Entity\Rate;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class RateController extends Controller{

    /**
     * @Route("/rate/")
     */
    public function addRateAction(Request $request){

        $rate = new Rate();
        $form = $this->createForm('GroupBundle\Form\RateType', $rate);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($rate);
            $em->flush();
        }

        return $this->render('@Group\GroupLiv\rating.html.twig',['form'=>$form->createView()]);

    }
}

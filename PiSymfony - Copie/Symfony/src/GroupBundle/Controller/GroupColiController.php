<?php

namespace GroupBundle\Controller;

use GroupBundle\Entity\GroupColi;
use GroupBundle\Entity\GroupLiv;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class GroupColiController extends Controller{

    /**
     * @Route ("/addColi/{GID}", name="addColi")
     */

    public function addColiAction(Request $request, $GID){
        $coli = new GroupColi();
        $toDay = new \DateTime();
        $toDay->getTimestamp();
        $coli->setDateAjout($toDay);
        $coli->setIdGroup($GID);
        $group = new GroupLiv();
        $group->setIdGroup($GID);

        $form = $this->createForm('GroupBundle\Form\GroupColiType', $coli);
        $form->handleRequest($request);

        if($form->isValid() && $form->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($coli);
            $em->flush();

        }

        return $this->render('@Group/GroupColi/addColi.html.twig',["form"=>$form->createView()]);
    }
}

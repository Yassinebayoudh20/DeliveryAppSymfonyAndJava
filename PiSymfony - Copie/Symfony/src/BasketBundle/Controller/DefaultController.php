<?php

namespace BasketBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use BasketBundle\Entity\BasketEntity;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends Controller
{
    /**
     * @Route("/basketpage/", name="show_basket")
     */
    public function afficher_panierAction(Request $request)
    {
        $produit=$this->getDoctrine()->getRepository(BasketEntity::class)->findAll();
        /**
         * @var $pagination /Knp/Component/Pager/Paginator
         */
          $paginator = $this->get('knp_paginator');
          $result = $paginator->paginate(
              $produit,
              $request->query->getInt('page',1),
              $request->query->getInt('limite',5)
          );
        return $this->render('@Basket/Default/Basket.html.twig',array("pagination"=>$result,"tobaskets"=>$produit));
    }
    public function afficher_commande_backAction()
    {
        $produit=$this->getDoctrine()->getRepository(BasketEntity::class)->findAll();

        return $this->render(array("tobaskets"=>$produit));


    }

    /**
     * @Route("/basketpage/{id}", name="delete_basket")
     */
    public function supprimercommandeAction($id){
        $em=$this->getDoctrine()->getManager();
        $com=$em->getRepository(BasketEntity::class)->findBy(["id"=>$id]);
        $em->remove($com[0]);
        $em->flush();
        return $this->redirectToRoute("show_basket");

    }

    /**
     * @Route("/basketemail/{id}", name="sendmail")
     */
  public function mailtester ($id){
      $message = (new \Swift_Message('Thank your for your time and trust'))
          ->setFrom('testPI@testPI.com')
          ->setTo('abderrahman.bedoui@gamil.com')
          ->setBody("welcome");
      $this->get('mailer')->send($message);
        $em=$this->getDoctrine()->getManager();
        $bas=$em->getRepository(BasketEntity::class)->find($id);
        $em->remove($bas);
        $em->flush();

      return $this->redirectToRoute("show_basket");


  }

    /**
     * @Route("/deepSearch/",name="searchPArNom")
     */
  public function findAction (Request $request){

      $em=$this->getDoctrine()->getManager();
      if($request->isMethod('POST')) {
          $nom = $_POST["name"];
          $quantite = $_POST["quantite"];
          #search and get result
          $parcel = $em->getRepository(BasketEntity::class)->getColiAdvanced($nom,$quantite);
          return $this->render("@Basket/Default/Basket.html.twig",["tobaskets"=>$parcel]);
      }
  }
}

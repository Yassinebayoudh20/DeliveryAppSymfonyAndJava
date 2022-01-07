<?php

namespace GroupBundle\Controller;

use AppBundle\Entity\Personne;
use AppBundle\Entity\User;
use GroupBundle\Entity\GroupColi;
use GroupBundle\Entity\GroupLiv;
use GroupBundle\Entity\Rate;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\DependencyInjection\Tests\Compiler\G;
use Symfony\Component\HttpFoundation\Request;

class GroupLivController extends Controller
{
    /**
     * @Route("/show/", name="show_groups")
     */
    public function showAction(Request $request)
    {

        $groupl = new GroupLiv();
        $etat = $this->getDoctrine()->getManager()->getRepository(User::class)->find($this->container->get('security.token_storage')->getToken()->getUser());
        $groupl->setIdAdmin($etat);

        $form= $this->createForm('GroupBundle\Form\GroupLivType', $groupl);
        $form->handleRequest($request);

        if($form->isValid() && $form->isSubmitted() ){
            $em =$this->getDoctrine()->getManager();
            $em->persist($groupl);
            $em->flush();

            unset($groupl);
            unset($form);

            $groupl = new GroupLiv();
            $form = $this->createForm('GroupBundle\Form\GroupLivType', $groupl);

        }

        #get all the groups
        $group = $this->getDoctrine()->getRepository(GroupLiv::class)->showGrpLiv();

        #iterate over group array
        for($i = 0; $i<=count($group)-1; $i++){
            #get the rate of each group by id
            $rate = $this->getDoctrine()->getRepository(Rate::class)->getGrpRate($group[$i]->getIdGroup());
            #calculate the average of the rate
            $avg = $this->calcRate($rate);
            #set each rate to its group
            $group[$i]->setRating($avg);
        }

        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $group,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',5)
        );

        return $this->render('@Group/GroupLiv/show1.html.twig', ["group" => $result, "form"=>$form->createView()]);

    }

    /**
     * @Route("/add")
     */

    public function addAction(Request $request){



        $group = new GroupLiv();
        $etat = $this->getDoctrine()->getManager()->getRepository(User::class)->find($this->container->get('security.token_storage')->getToken()->getUser());
        $group->setIdAdmin($etat);

        $form= $this->createForm('GroupBundle\Form\GroupLivType', $group);
        $form->handleRequest($request);

        if($form->isValid() && $form->isSubmitted() ){
            $em =$this->getDoctrine()->getManager();
            $em->persist($group);
            $em->flush();


        }

        return $this->render("@Group/GroupLiv/add.html.twig", ["form"=>$form->createView()]);

    }

    public function calcRate($rateArr){

        if (!empty($rateArr)) {
            $s = 0;
            $i = 0;

            foreach ($rateArr as $r) {
                $s += $r->getRateValue();
                $i++;
            }

            $avg = $s / $i;
        }else{
            $avg = 0;
        }

        return $avg;

    }

    public function addColi(Request $request, $GID, $form){
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
    }

    /**
     * @Route("/grpDet/{id}", name="details")
     */

    public function grpDetailsAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();
        $group = $em->getRepository(GroupLiv::class)->find($id);

        $rate = $em->getRepository(Rate::class)->getGrpRate($id);
        $users = $em->getRepository(User::class)->findByid($id);

        $parcel = $em->getRepository(GroupColi::class)->getColi($id);

        $avg = $this->calcRate($rate);

        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $users,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 5)
        );

        $coli = new GroupColi();
        $toDay = new \DateTime();
        $toDay->getTimestamp();
        $coli->setDateAjout($toDay);
        $coli->setIdGroup($group);
        $currentUser = $em->getRepository(User::class)->find($this->container->get('security.token_storage')->getToken()->getUser());
        $coli->setIdUtil($currentUser);
        #$group = new GroupLiv();
        $group->setIdGroup($id);

        $form = $this->createForm('GroupBundle\Form\GroupColiType', $coli);
        $form->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($coli);
            $em->flush();

            unset($coli);
            unset($form);

            $coli = new GroupColi();
            $form = $this->createForm('GroupBundle\Form\GroupColiType', $coli);
        }

        return $this->render("@Group/GroupLiv/grpDetails.html.twig", [
            "group" => $group,
            "rate" => $avg,
            "members" => $result,
            "coli" => $parcel,
            "formP" => $form->createView()
        ]);
    }
}

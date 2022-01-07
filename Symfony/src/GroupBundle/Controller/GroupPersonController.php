<?php

namespace GroupBundle\Controller;

use AppBundle\Entity\User;
use GroupBundle\Entity\GroupLiv;
use GroupBundle\Entity\GroupPerson;
use GroupBundle\GroupBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GroupPersonController extends Controller{


    /**
     * @Route("/join/{gid}", name="join")
     */

    public function joinAction($gid, Request $request){
        $session = $request->getSession();
        # new instance of GroupPerson
        $groupPerson = new GroupPerson();
        #instance of GroupLiv
        $group = new GroupLiv();
        #get the group by id
        $group = $this->getDoctrine()->getManager()->getRepository(GroupLiv::class)->find($gid);
        #set the group id
        $groupPerson->setIdGroup($group);
        #get the logged in user
        $currentUser = $this->getDoctrine()->getManager()->getRepository(User::class)->find($this->container->get('security.token_storage')->getToken()->getUser());
        #check if the user is already a member
        $arr = $this->getDoctrine()->getManager()->getRepository(GroupPerson::class)->isMember($currentUser->getId(), $gid);

        if(empty($arr)) {

            #set the user
            $groupPerson->setIdUtilisateur($currentUser);
            #get the current date
            $toDay = new \DateTime();
            $toDay->getTimestamp();
            #set the membership date
            $groupPerson->setDateAjout($toDay);

            $em = $this->getDoctrine()->getManager();

            $em->persist($groupPerson);
            $em->flush();

            #return $this->render('@Group/GroupPerson/join.html.twig', ["group" => $group]);
        }else{
            #return new Response('you are already a member');
            $session->getFlashBag()->add('error','already');
        }

        #return $this->render('@Group/GroupPerson/join.html.twig', ["group"=>$group]);
        return $this->forward("GroupBundle:GroupLiv:grpDetails",["id"=>$gid]);

        }

    /**
     * @Route("/leave/{gid}", name="leave")
     */
        public function leaveGroupAction($gid){
            $em = $this->getDoctrine()->getManager();
            $currentUser = $em->getRepository(User::class)->find($this->container->get('security.token_storage')->getToken()->getUser());
            $query = $em->createQueryBuilder()
                ->delete('GroupBundle:GroupPerson', 'g')
                ->where('g.idUtilisateur = :pid')
                ->setParameter("pid", $currentUser->getId())
                ->andWhere('g.idGroup = :gid')
                ->setParameter('gid',$gid)
                ->getQuery();
            $query->execute();
            #$em->getRepository(GroupPerson::class)->deleteMember($currentUser->getId(),$gid );
            $em->flush();
            #return $this->render('@Group/GroupPerson/show.html.twig');
            return $this->redirect('127.0.0.1:8000/group/show/');

        }

}

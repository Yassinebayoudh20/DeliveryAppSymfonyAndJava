<?php

namespace NotificationBundle\Controller;

use NotificationBundle\Entity\Notifications;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/show",name="show_notif")
     */
    public function showAction()
    {
        $listNotif = $this->getDoctrine()->getManager()->getRepository(Notifications::class)->findAll();
        $rowNumber = sizeof($listNotif);
        return $this->render('@Notification/Default/showNotif.html.twig',["listNotif"=>$listNotif , "rowNumber"=>$rowNumber]);
    }
}

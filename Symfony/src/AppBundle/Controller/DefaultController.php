<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
    * @Route("/", name="homepage")
    */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('frontOffice/Basket.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/chatroom", name="chatroom")
     */
    public function chatAction(Request $request)
    {
        return $this->render("default/chat.html.twig");
    }
}

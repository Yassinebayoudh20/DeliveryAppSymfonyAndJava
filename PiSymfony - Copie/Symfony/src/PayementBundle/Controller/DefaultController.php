<?php

namespace PayementBundle\Controller;

use AppBundle\Entity\Colis;
use Doctrine\ORM\Mapping\Entity;
use PayementBundle\Entity\Customer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Security\Core\Security;
use AppBundle\Entity\User;

class DefaultController extends Controller
{

    /**
     * @Route("/card" , name="pay_show")
     */
    public function indexAction(Request $request)
    {
        $customer = new Customer();
        //Getting Current user
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        \Stripe\Stripe::setApiKey('sk_test_2APKdZmMUOLIX9CiUu3hdB9Z00kd880Rdb');
        $form = $this->get('form.factory')
            ->createNamedBuilder('payment-form')
            ->add('token', HiddenType::class, [
                'constraints' => [new NotBlank()],
            ])
            ->add('submit', SubmitType::class)
            ->getForm();
        $userRepo = $em->getRepository('PayementBundle:Customer');
        $cust = $userRepo->findOneById($this->container->get('security.token_storage')->getToken()->getUser());
      ;
        if ( !empty($cust) ){
           //We are going to render to an existing credit card page
            $RetrievedCustomer = \Stripe\Customer::retrieve($cust[0]->getId());
            return $this->render('@Payement/Default/myCards.html.twig',["test"=>$RetrievedCustomer,
            'form' => $form->createView(),
            'stripe_public_key' => $this->getParameter('stripe_public_key')
            ]);
        }else{
        //var_dump($cust[0]->getId());
        //Check if email exist then show an other View <<<<
        if ($request->isMethod('POST')) {
                $form->handleRequest($request);
                if ($form->isValid()) {
                    // Getting Form Data
                    $firstName = $request->request->get('first_name');
                    $lastName = $request->request->get('last_name');
                    $token = $request->request->get("payment-form_token");
                    $userEmail = $user->getEmail();
                    $customer->setEmail($userEmail);
                    $customer->setIduser($this->container->get('security.token_storage')->getToken()->getUser());
                    $customer->setDatecreation(new \DateTime());
                    $customer->setFullname($firstName . " " . $lastName);
                    $stripe_customer = \Stripe\Customer::create([
                        'description' => 'This Client has been created by Fithnitek Project',
                        'source' => 'tok_visa',
                        'email' => $userEmail,
                        'name' => $firstName . " " . $lastName
                    ]);
                    $customer->setId($stripe_customer->id);
                    $em->persist($customer);
                    $em->flush();
                }
            }
        }
        return $this->render('@Payement/Default/payement.html.twig', [
            'form' => $form->createView(),
            'stripe_public_key' => $this->getParameter('stripe_public_key')
        ]);
    }


        /**
         * @Route("/charge/{idColis}" , name="chargeCustomer")
         */
        public function chargeAction($idColis){
            \Stripe\Stripe::setApiKey('sk_test_2APKdZmMUOLIX9CiUu3hdB9Z00kd880Rdb');
            $em = $this->getDoctrine()->getManager();
            $userRepo = $em->getRepository('PayementBundle:Customer');
            $cust = $userRepo->findOneById($this->container->get('security.token_storage')->getToken()->getUser());

            // Here we are going to retrieve the package and get its price to charge it
            $colis = new Colis();

            $charge = \Stripe\Charge::create([
                'amount' => $colis->getReward(),
                'currency' => 'usd',
                'customer' => $cust[0]->getId()
            ]);

        }

    /**
     * @Route("/updatecard/{id}" , name="update_card")
     */
        public function updateCardAction($id)
        {
            \Stripe\Stripe::setApiKey('sk_test_2APKdZmMUOLIX9CiUu3hdB9Z00kd880Rdb');

            $firstName = $_POST['first_name'];
            $lastName =$_POST['last_name'];
            $custInfo = \Stripe\Customer::update
                    (
                        $id,
                        ['name' => $firstName." ".$lastName,
                            'description' => "TESTTTT"
                        ]
                    );
                return $this->redirectToRoute("pay_show" ,["test"=> $custInfo]);
        }


    /**
     * @Route("/deletecard/{id}" , name="delete_card")
     */
        public function deleteCustomerCardAction($id){
            \Stripe\Stripe::setApiKey('sk_test_2APKdZmMUOLIX9CiUu3hdB9Z00kd880Rdb');
            $customer = \Stripe\Customer::retrieve(
                $id
            );
            $customer->delete();
            $em = $this->getDoctrine()->getManager();
            $customer = $em->getRepository(Customer::class)->find($id);
            $em->remove($customer);
            $em->flush();
            return $this->redirectToRoute("pay_show");
        }
}

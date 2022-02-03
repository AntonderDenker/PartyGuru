<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailerController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{

    public function sendEmail(MailerInterface $mailer): Response
    {
        $email = (new Email())
            ->from('argus@antonhauffe.de')
            ->to('antonhauffe2703@gmail.com')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html('<p>See Twig integration for better HTML integration!</p>');

       return $mailer->send($email);
    }

}
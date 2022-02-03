<?php

namespace App\Controller;

use App\Entity\Party;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PartyController extends AbstractController
{
    #[Route('/create_party', name: 'create_party')]
    public function create_party(EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted("ROLE_VERIFIED");


        if(isset($_POST["party"]))
        {
            if(isset($_POST["guest_amount"])){$guest_amount = $_POST["guest_amount"];}else{$guest_amount = null;}
            if(isset($_POST["guest_list"])){$guest_list = $_POST["guest_list"];}else{$guest_list = null;}
            $verification_type = $_POST["verification_type"];

            $zip_code = $_POST["zip_code"];
            $city = $_POST["city"];
            $street = $_POST["street"];
            $street_number = $_POST["street_number"];

            $date = $_POST["date"];
            $start_time = $_POST["start_time"];

            if(isset($_POST["guest_list"])){$end_time = $_POST["end_time"];}else{$end_time = null;}
            if(isset($_POST["telephone_number"])){$tel_numb = $_POST["telephone_number"];}else{$tel_numb = null;}
            if(isset($_POST["email_address"])){$email_address = $_POST["email_address"];}else{$email_address = null;}


            $party = new Party();
            $party->setGuestAmount($guest_amount);
            $party->setGuestList($guest_list);
            $party->setVerificationType($verification_type);
            $party->setZipCode($zip_code);
            $party->setCity($city);
            $party->setAdress($street." ".$street_number);
            $party->setDate($date);
            $party->setStartTime($start_time);
            $party->setEndTime($end_time);
            $party->setEmail($email_address);
            $party->setTelephoneNumber($tel_numb);
            $party->setCreatedDate(new \DateTime());

            $entityManager->persist($party);
            $entityManager->flush();


        }


        return $this->render('party/create_party.html.twig', [
            'controller_name' => 'PartyController',
        ]);
    }
}

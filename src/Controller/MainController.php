<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;


class MainController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{

    /**
     * @Route ("/", name="index")
     */

    public function index()
    {
       return $this->render("index.html.twig", []);
    }

    /**
     * @Route ("/create_party", name="create_party")
     */

    public function create_party()
    {
        return $this->render("create_party.html.twig");
    }

    /**
     * @Route ("/find_party", name="find_party")
     */

    public function find_party()
    {
        return $this->render("find_party.html.twig");
    }

    /**
     * @Route ("/impressum", name="impressum")
     */

    public function impressum()
    {
        return $this->render("impressum.html.twig");
    }

    /**
     * @Route ("/datenschutz", name="datenschutz")
     */

    public function datenschutz()
    {
        return $this->render("datenschutz.html.twig");
    }
}
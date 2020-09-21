<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route ("/about_us",name="about_us")
     */
    public function AboutUs()
    {
        return $this->render("main/about_us.html.twig");
    }
    /**
     * @Route("/",name="home")
     */
    public function Home()
    {
        $user= $this->getUser();

        return $this->render("main/home.html.twig",['user'=>$user]);
    }

    /**
     * @Route ("/essai",name="essai")
     */
    public function T()
    {
       return $this->render("main/essai.html.twig") ;
    }


}
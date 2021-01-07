<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class mainController extends AbstractController {
    
    /**
     * @Route("/", name="home_page")
     */
    public function home()  {
        return $this->render("home.html.twig");
    }
    
    /**
     * @Route("/test", name="test_page")
     */
    public function test()  {
        return $this->render("home.html.twig");
    }
}

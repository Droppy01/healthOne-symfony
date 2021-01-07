<?php
namespace App\Controller;

use App\Entity\Medication;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class mainController extends AbstractController {
    
    /**
     * @Route("/", name="home_page")
     */
    public function home()  {
        return $this->render("home.html.twig");
    }
    
    /**
     * @Route("/medicijnen", name="medicijnen_page")
     */
    public function showMedicijnen() : Response   {
        $medications = $this->getDoctrine()->getManager()->getRepository(Medication::class)->findAll();




        return $this->render("medicijnen.html.twig", ["medications"=>$medications] );
    }
}

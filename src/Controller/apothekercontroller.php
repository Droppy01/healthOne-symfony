<?php


namespace App\Controller;


use App\Repository\PrescriptionRepository;
use Symfony\Component\Routing\Annotation\Route;

class apothekercontroller extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    /**
     * @Route("/recepten", name="apotheker_Prescription_View")
     */
    public function PrescriptionView(PrescriptionRepository $repo) {
        $Prescriptions = $repo->findAll();                                                           // sudo apt update
        return $this->render("PrescriptionView.html.twig", ["Prescriptions"=>$Prescriptions]);  // sudo apt upgrade (:P)

    }
}
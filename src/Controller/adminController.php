<?php


namespace App\Controller;



use App\Form\medicationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class adminController
 * @package App\Controller
 * @Route ("/admin")
 */
class adminController extends AbstractController
{
    /**
     * @Route ( "/medication/new")
     */
    public function newArtical( EntityManagerInterface $em) {
        $form = $this->createForm(medicationFormType::class);

        return $this->render("medicationForm.html.twig", ["form"=>$form->createView() ] );
    }
}
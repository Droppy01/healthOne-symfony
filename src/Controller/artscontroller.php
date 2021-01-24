<?php


namespace App\Controller;


use App\Entity\Customer;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class artscontroller extends AbstractController
{

     //@Security ("is_granted('ROLE_ADMIN') or is_granted('ROLE_DOCTOR')" ) werkt niet
     /** @Route ("/klanten", name="arts_Customers_Vieuw")
     */
    public function getCustomers(EntityManagerInterface $em) {
        $Customers = $em->getRepository(Customer::class)->findAll();
        return $this->render("customersVieuw.html.twig", ["Customers"=>$Customers]);
    }

    /**
     * @Route ("/klant/{id}", name="arts_Customer_Vieuw")
     */
    public function getCustomer(Customer $customer) {

    return $this->render("customerVieuw.html.twig", ["klant"=>$customer]);
    }
}
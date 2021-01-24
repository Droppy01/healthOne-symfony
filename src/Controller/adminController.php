<?php


namespace App\Controller;



use App\Entity\Customer;
use App\Entity\Medication;
use App\Entity\Prescription;
use App\Form\CustomerFormType;
use App\Form\medicationFormType;
use App\Form\PrescriptionFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route ("/admin")
 */
class adminController extends AbstractController
{
    /**
     * @Route ( "/medication/new", name="admin_medication_add")
     */
    public function newMedication( EntityManagerInterface $em, Request $request) {
        $form = $this->createForm(medicationFormType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $medication = new Medication();
            $medication
                ->setName($data["name"])
                ->setPharmaceuticalCompany($data["pharmaceuticalCompany"])
                ->setInsured($data["insured"])
                ->setPrice($data["price"])
                ->setDescription($data["description"])
                ->setEffect($data["effect"])
                ->setSideEffect($data["sideEffect"])
            ;
            $em->persist($medication);
            $em->flush();

            return $this->redirectToRoute("medicijnen_page");

        }else {
            return $this->render("Form.html.twig", ["form"=>$form->createView(),  "Formtitle"=>"adding a medication" ] );
        }

    }

    /**
     * @Route("/medication/{id}", name="admin_medication_delete", methods={"DELETE"})
     */
    public function deleteMedication(Request $request, Medication $medication)
    {
        if ($this->isCsrfTokenValid('delete'.$medication->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($medication);
            $entityManager->flush();
        }

        return $this->redirectToRoute('medicijnen_page');
    }

    /**
     * @Route("/medication/{id}/edit", name="admin_medication_edit", methods={"GET","POST"})
     */
    public function editMedication(Request $request, Medication $medication)
    {
        $form = $this->createForm(medicationFormType::class, $medication);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('customer_index');
        }

        return $this->render('Form.html.twig', [
            'Formtitle' => "medicijen bijwerken",
            'customer' => $medication,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/patienten/{id}", name="admin_Customer_delete", methods={"DELETE"})
     */
    public function deleteCustomer(Request $request, Customer $customer)
    {
        if ($this->isCsrfTokenValid('delete'.$customer->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($customer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('arts_Customers_Vieuw');
    }
    /**
     * @Route("/Customer/{id}/edit", name="admin_Customer_edit", methods={"GET","POST"})
     */
    public function editCustomer(Request $request, Customer $customer)
    {
        $form = $this->createForm(CustomerFormType::class, $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('arts_Customer_Vieuw', ["id" => $customer->getId()]);
        }

        return $this->render('Form.html.twig', [
            'Formtitle' => "medicijen bijwerken",
            'customer' => $customer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route ( "/patienten/new", name="admin_Customer_add")
     */
    public function newCustomer( EntityManagerInterface $em, Request $request) {
        $form = $this->createForm(CustomerFormType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $customer = new Customer();
            $customer
                ->setFirstName($data["firstName"])
                ->setPrefix($data["prefix"])
                ->setLastName($data["lastName"])
                ->setCustomerId($data["customerId"])
                ->setAddress($data["Address"])
                ->setZipCode($data["zipCode"])
                ->setCity($data["city"])
            ;
            $em->persist($customer);
            $em->flush();

            return $this->redirectToRoute("admin_Customer_Vieuw");

        }else {
            return $this->render("Form.html.twig", ["form"=>$form->createView(),  "Formtitle"=>"adding a customer" ] );
        }

    }


    /**
     * @Route ( "/Prescription/new", name="admin_Prescription_add")
     */
    public function newPrescription( EntityManagerInterface $em, Request $request) {
        $form = $this->createForm(PrescriptionFormType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $Prescription = new Prescription();
            $Prescription
                ->setCustomer($data["Customer"])
                ->setMedication($data["medication"])
                ->setDate(new \DateTime())
                ->setDose($data["dose"])
            ;
            $em->persist($Prescription);
            $em->flush();
            return $this->redirectToRoute("home_page");
        }else {
            return $this->render("Form.html.twig", ["form"=>$form->createView() , "Formtitle"=>  "test"] );
        }
    }

}
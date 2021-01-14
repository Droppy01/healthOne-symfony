<?php
namespace App\Controller;

use App\Entity\Medication;

use Exception;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class mainController extends AbstractController {
    /*
    ---- INDEX ----
    route:  "/"             *       home()
    route:  "/medicijnen"   GET     showMedications()
    route:  "/medicijnen"   post    addMedication()
    route:  "/medicijnen"   DELETE  removeMedication()
    route:  "/medicijnen"   PUT     editMedication()
    function: getEntryByIdFromQuery()
    function: autofillMedication()
    function: getDataFromHtmlBody()
    */

    /**
     * @Route("/", name="home_page")
     */
    public function home()  {
        return $this->render("home.html.twig");
    }
    
    /**
     * @Route("/medicijnen", name="medicijnen_page", methods={"GET"})
     */
    public function showMedications() : Response   {
        $medications = $this->getDoctrine()->getManager()->getRepository(Medication::class)->findAll();
        return $this->render("medicijnen.html.twig", ["medications"=>$medications] );
    }

    /**
     * @Route("/medicijnen", name="medicijn_toevoegen", methods={"post"})
     */
    public function addMedication(Request $request) {
        $data = $this->getDataFromHtmlBody($request);

        $Medication = $this->autofillMedication(new Medication(), $data);

        // TODO validate Request

        $Manager = $this->getDoctrine()->getManager();
        $Manager->persist($Medication);
        $Manager->flush();

        return new JsonResponse($data);
    }

    /**
     * @Route("/medicijnen", name="medicijn_verwijderen", methods={"DELETE"})
     */
    public function removeMedication(Request $request) {
        // DELETE /medicijnen?id=2

            $Manager = $this->getDoctrine()->getManager();
            $medication = $this->getEntryByIdFromQuery($Manager, $request, Medication::class);

            if ($medication !== null) {
                $id =
                // delete
                $Manager->remove($medication);
                $Manager->flush();
                return new JsonResponse(array(
                   "success"=>"medication (".$medication->getId().") deleted"
                ));
            } else {
                $response = new JsonResponse( array(
                    "error"=>"medication (".$request->query->get("id").") does not exist"
                ));
                $response->setStatusCode(404);
                return $response;
            }

    }

    /**
     * @Route("/medicijnen", name="medicijn_Bijwerken", methods={"PUT"})
     */
    public function editMedication(Request $request) {
        /*
        PUT /medicijnen?id=2
        Content-Type: application/json
        */
        $Manager = $this->getDoctrine()->getManager();
        try {
            $medication = $this->autofillMedication(
                $this->getEntryByIdFromQuery($Manager, $request, Medication::class),
                $this->getDataFromHtmlBody($request)
            );

            $Manager->persist($medication);
            $Manager->flush();
            return new JsonResponse(array(
                $medication->getId() =>array(
                    "Price"=>$medication->getPrice(),
                    "Insured"=>$medication->getInsured(),
                    "Name"=>$medication->getName(),
                    "PharmaceuticalCompany"=>$medication->getPharmaceuticalCompany()
                )
            ));
        }catch (Exception $error) {
            if ($error->getMessage() == "dit not get Medication class") {
                $response = new JsonResponse(array(
                    "error"=>"could not find the medication"
                ));
                $response->setStatusCode(500);
                return $response;
            }
        }
    }

    /**
     * @param ObjectManager $Manager
     * @param Request $request
     * @param $class
     * @return object|null
     */
    public function getEntryByIdFromQuery(ObjectManager $Manager, Request $request, $class ) {
        $id = (int) $request->query->get("id");
        if ($id == null) {
            return null;
        } else {
            return $Manager->getRepository($class)->findOneBy(array("id"=>$id));
        }
    }

    /**
     * @param Medication|object $medication
     * @param array $data
     * @return Medication
     * @throws \Exception
     */
    public function autofillMedication($medication, array $data) : Medication {
        if (! $medication instanceof Medication) {
            throw new Exception("dit not get Medication class");
        }
        if (isset($data["Price"])) {
            $medication->setPrice($data["Price"]);
        }

        if (isset($data['Name'])) {
            $medication->setName($data['Name']);
        }

        if (isset($data["PharmaceuticalCompany"])) {
            $medication->setPharmaceuticalCompany($data["PharmaceuticalCompany"]);
        }

        if (isset($data["Insured"])) {
            $medication->setInsured($data["Insured"]);
        }

        return $medication;
    }

    /**
     * @param Request $request
     * @return array|null
     */
    public function getDataFromHtmlBody(Request $request) {
        switch ($request->getContentType()) {
            case "json":
                $data = json_decode($request->getContent(), true);
                break;
            default:
                $data = null;
                break;
        }
        return $data;
    }




}

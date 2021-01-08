<?php
namespace App\Controller;

use App\Entity\Medication;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/medicijnen", name="medicijnen_page", methods={"get"})
     */
    public function showMedications() : Response   {
        $medications = $this->getDoctrine()->getManager()->getRepository(Medication::class)->findAll();
        return $this->render("medicijnen.html.twig", ["medications"=>$medications] );
    }

    /**
     * @Route("/medicijnen", name="medicijn_toevoegen", methods={"post"})
     */
    public function addMedication(Request $request) {
        if($request->getContentType() == "json") {
            $data = json_decode($request->getContent(), true);
        }

        $Medication = new Medication();

        if (isset($data["Price"])) {
            $Medication->setPrice($data["Price"]);
        }

        if (isset($data['Name'])) {
            $Medication->setName($data['Name']);
        }

        if (isset($data["PharmaceuticalCompany"])) {
            $Medication->setPharmaceuticalCompany($data["PharmaceuticalCompany"]);
        }

        if (isset($data["Insured"])) {
            $Medication->setInsured($data["Insured"]);
        }

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
        $id = (int) $request->query->get("id");

        if ($id == null) {
            $response = new JsonResponse(array(
            "error"=>"dit not get parameter id, or parameter id is not valid  "
        ));
            $response->setStatusCode(400);
            return $response;

        } else {
            $Manager = $this->getDoctrine()->getManager();
            $medication = $Manager->getRepository(Medication::class)->findOneBy(array("id"=>$id));

            if ($medication !== null) {

                // delete
                $Manager->remove($medication);
                $Manager->flush();
                return new JsonResponse(array(
                   "sucsess"=>"medication (".$id.") deleted"
                ));
            } else {
                $response = new JsonResponse( array(
                    "error"=>"medication (".$id.") does not exist"
                ));
                $response->setStatusCode(404);
                return $response;
            }
        }
    }


}

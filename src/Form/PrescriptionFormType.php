<?php


namespace App\Form;


use App\Entity\Customer;
use App\Entity\Medication;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class PrescriptionFormType extends \Symfony\Component\Form\AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("dose", IntegerType::class)
            ->add("medication", EntityType::class , [
                "class"=>Medication::class ,
                "choice_label" => function (Medication $medication) {
                return (string) $medication->getPharmaceuticalCompany() ."'s: ". $medication->getName();
                }
            ])
            ->add("Customer", EntityType::class , [
                "class"=>Customer::class ,
                "choice_label" => function (Customer $Customer) {
                    return (string) $Customer->getFirstName() ." ". $Customer->getPrefix()." ".$Customer->getLastName();
                }
            ])
            ->add("submit", SubmitType::class, ["attr"=>["class"=>'btn btn-primary'], "label"=>"opslaan"])

        ;
    }
}
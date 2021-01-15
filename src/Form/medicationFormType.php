<?php


namespace App\Form;


use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class medicationFormType extends \Symfony\Component\Form\AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ["attr"=>["class"=>"form-control"]] )
            ->add('pharmaceuticalCompany', TextType::class, ["attr"=>["class"=>"form-control"]])
            ->add("price", MoneyType::class, ["currency"=>"EUR","attr"=>["class"=>"form-control"]])
            ->add("insured", CheckboxType::class, ['required' => false,"attr"=>["class"=>"form-check-input"]] )
            ->add("description", null , ["attr"=>["class"=>"form-control"]])
            ->add("sideEffect", TextareaType::class, ["attr"=>["class"=>"form-control"]])
            ->add("effect", TextareaType::class, ["attr"=>["class"=>"form-control"]])
            ->add("submit", SubmitType::class, ["attr"=>["class"=>'btn btn-primary'], "label"=>"opslaan"])
        ;

    }

}
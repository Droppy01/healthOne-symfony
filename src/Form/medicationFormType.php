<?php


namespace App\Form;


use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class medicationFormType extends \Symfony\Component\Form\AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('pharmaceuticalCompany', TextType::class)
            ->add("price", MoneyType::class, ["currency"=>"EUR"])
            ->add("insured", CheckboxType::class, ['required' => false] )
            ->add("description")
            ->add("sideEffect", TextareaType::class)
            ->add("effect", TextareaType::class)
        ;

    }

}
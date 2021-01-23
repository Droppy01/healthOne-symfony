<?php


namespace App\Form;


use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class CustomerFormType extends \Symfony\Component\Form\AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class)
            ->add('prefix', TextType::class, ['required'   => false])
            ->add('lastName', TextType::class)
            ->add('customerId', TextType::class)
            ->add('Address', TextType::class)
            ->add('zipCode', TextType::class, ['required'   => false])
            ->add('city', TextType::class)
            ->add("submit", SubmitType::class, ["attr"=>["class"=>'btn btn-primary'], "label"=>"opslaan"])
        ;

    }
}
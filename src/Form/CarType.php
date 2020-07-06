<?php

namespace App\Form;

use App\Entity\Car;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mark', ChoiceType::class, [
                'choices' => [
                    'Alfa Romeo' => "Alfa Romeo",
                    'Audi' => "Audi",
                    'BMW' => "BMW",
                    'Chevrolet' => "Chevrolet",
                    'Chrysler' => "Chrysler",
                    'Citroen' => "Citroen",
                    'Dacia' => "Dacia",
                    'Fiat' => "Fiat",
                    'Ford' => "Ford",
                    'Mercedes' => "Mercedes",
                    'Honda' => "Honda",
                    'Hyundai' => "Hyundai",
                    'Kia' => "Kia",
                    'Mazda' => "Mazda",
                    'Mercedes' => "Mercedes",
                    'Nissan' => "Nissan",
                    'Opel' => "Opel",
                    'Peugeot' => "Peugeot",
                    'Porsche' => "Porsche",
                    'Renault' => "Renault",
                    'Skoda' => "Skoda",
                    'Volkswagen' => "Volkswagen",
                ],
            ])
            ->add('model')
            ->add('yearProd')
            ->add('engineType', ChoiceType::class, [
                'choices' => [
                    'Gasoline' => "Gasoline",
                    'Diesel' => "Diesel",
                    'Hybrid' => "Hybrid",
                    'Electric' => "Electric",
             ],
            ])
            ->add('engineCapacity')
            ->add('vin')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Constant\StreetType;
use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('number', IntegerType::class,[ 
            ])
            ->add('streetType',ChoiceType::class,[
                'choices' => array_flip(StreetType::STREETTYPES),
            ])
            ->add('streetName', TextType::class,[

            ])
            ->add('city', TextType::class,[

            ])
            ->add('zipCode', NumberType::class,[

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}

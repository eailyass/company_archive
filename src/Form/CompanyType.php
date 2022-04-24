<?php

namespace App\Form;

use App\Entity\Status;
use App\Entity\Company;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class CompanyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class,[])
            ->add('immatriculationDate',DateType::class,[
                'widget' => 'single_text',
            ])
            ->add('immatriculationCity',TextType::class,[])
            ->add('siren',TextType::class,[])
            ->add('capital',NumberType::class)
            ->add('status', EntityType::class,[
                "required" => true,
                "class" => Status::class,
                'choice_label' => 'name',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Company::class,
        ]);
    }
}

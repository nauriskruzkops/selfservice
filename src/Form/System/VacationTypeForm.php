<?php

namespace App\Form\System;

use App\Entity\Company;
use App\Entity\VacationType;
use App\Repository\CompanyRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VacationTypeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('company', EntityType::class, [
                'class' => Company::class,
                'query_builder' => function (CompanyRepository $er) {
                    return $er->getSelectList();
                },
                'choice_label' => 'title',
                'attr' => [
                    'class' => 'form-control hide',
                ],
            ])
            ->add('title', TextType::class, [
                'attr' => ['class' => 'form-control'],
            ])
            ->add('daysLeave', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Max Days Leave',
            ])
            ->add('paidPercents', TextType::class, [
                'attr' => ['class' => 'form-control'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => VacationType::class,
        ));
    }
}

?>
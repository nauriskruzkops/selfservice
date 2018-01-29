<?php

namespace App\Form\System;

use App\Entity\Company;
use App\Entity\CompanyDepartment;
use App\Entity\CompanyEmployee;
use App\Repository\CompanyDepartmentRepository;
use App\Repository\CompanyRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\OptionsResolver\OptionsResolver;


class CompanyEmployeeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('company', EntityType::class, [
                'required' => true,
                'class' => Company::class,
                'query_builder' => function (CompanyRepository $er) {
                    return $er->getSelectList();
                },
                'choice_label' => 'title',
                'placeholder' => '-- Select --',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('department', EntityType::class, [
                'required' => true,
                'class' => CompanyDepartment::class,
                'query_builder' => function (CompanyDepartmentRepository $er) {
                    return $er->getSelectList();
                },
                'choice_label' => 'title',
                'placeholder' => '-- Select --',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('startDate', DateType::class, [
                'required' => true,
                'widget' => 'single_text',
                'label' => 'Labor period',
                'input' => 'datetime',
                'attr' => [
                    'placeholder' => 'Start date',
                ]
            ])
            ->add('endDate', DateType::class, [
                'required' => false,
                'widget' => 'single_text',
                'input' => 'datetime',
                'attr' => [
                    'placeholder' => 'End date',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => CompanyEmployee::class,
        ));
    }
}

?>
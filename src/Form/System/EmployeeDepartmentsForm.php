<?php

namespace App\Form\System;

use App\Entity\Company;
use App\Entity\CompanyDepartment;
use App\Entity\EmployeeDepartments;
use App\Entity\Employee;
use App\Repository\CompanyDepartmentRepository;
use App\Repository\CompanyRepository;
use App\Repository\EmployeeRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\OptionsResolver\OptionsResolver;


class EmployeeDepartmentsForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
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
            ->add('manager', EntityType::class, [
                'required' => false,
                'class' => Employee::class,
                'query_builder' => function (EmployeeRepository $er) {
                    return $er->getSelectList();
                },
                'choice_label' => 'getFullName',
                'placeholder' => '-- Select direct manager --',
                'label' => 'Direct manager',
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
            'data_class' => EmployeeDepartments::class,
        ));
    }
}

?>
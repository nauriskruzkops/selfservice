<?php

namespace App\Form\System;

use App\Entity\Company;
use App\Entity\Employee;
use App\Entity\User;
use App\Repository\CompanyRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmployeeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => ['class' => 'form-control'],
            ])
            ->add('surname', TextType::class, [
                'attr' => ['class' => 'form-control'],
            ])
            ->add('personalId', TextType::class, [
                'required' => false,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('email', EmailType::class, [
                'required' => false,
                'attr' => ['class' => 'form-control'],
            ])
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
            ->add('departments', CollectionType::class, [
                'entry_type' => EmployeeDepartmentsForm::class,
                'entry_options' => ['label' => false],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Employee::class,
        ));
    }
}

?>
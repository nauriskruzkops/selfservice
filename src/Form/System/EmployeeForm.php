<?php

namespace App\Form\System;

use App\Entity\Company;
use App\Entity\CompanyEmployee;
use App\Entity\Employee;
use App\Repository\CompanyRepository;
use App\Repository\EmployeeRepository;
use ArrayAccess;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Vocation;
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
                'attr' => ['class' => 'form-control'],
            ])
            //->add('companyRelation', CompanyEmployeeForm::class)
            ->add('companyRelation', CollectionType::class, [
                'entry_type' => CompanyEmployeeForm::class,
                'entry_options' => ['label' => false],
            ]);

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
<?php

namespace App\Form;

use App\Entity\Employee;
use App\Repository\EmployeeRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use App\Entity\Vocation;

class CalendarVocationForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', ChoiceType::class, array(
                'choice_translation_domain' => null,
                'choices'  => Vocation::TYPES,
                'attr' => [
                    'class' => 'form-control',
                ],
                'label_attr' => [

                ]
            ))

            ->add('employee', EntityType::class, array(
                'class' => Employee::class,
                'query_builder' => function (EmployeeRepository $er) {
                    return $er->getSelectList();
                },
                'choice_label' => 'fullName',
                'attr' => [
                    'class' => 'form-control',
                ],
                'label_attr' => [

                ]
            ))

            ->add('startDate', DateType::class)
            ->add('endDate', DateType::class)
        ;
    }
}

?>
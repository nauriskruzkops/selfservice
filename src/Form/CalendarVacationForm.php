<?php

namespace App\Form;

use App\Entity\Employee;
use App\Entity\VacationType;
use App\Repository\EmployeeRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use App\Entity\Vacation;

class CalendarVacationForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', EntityType::class, [
                'class' => VacationType::class,
                'choice_label' => 'title',
                'attr' => [
                    'class' => 'form-control',
                ],
                'label_attr' => []
            ])
            ->add('employee', EntityType::class, [
                'class' => Employee::class,
                'query_builder' => function (EmployeeRepository $er) {
                    return $er->getSelectList();
                },
                'choice_label' => 'fullName',
                'attr' => [
                    'class' => 'form-control',
                ],
                'label_attr' => []
            ])
            ->add('startDate', DateType::class, [
                'widget' => 'single_text',
                'input' => 'datetime',
            ])
            ->add('endDate', DateType::class, [
                'widget' => 'single_text',
                'input' => 'datetime',
            ])
        ;
    }
}

?>
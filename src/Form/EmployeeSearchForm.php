<?php

namespace App\Form;
;

use App\Entity\CompanyDepartment;
use App\Entity\VacationType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class EmployeeSearchForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', EntityType::class, [
                'class' => VacationType::class,
                'choice_label' => 'title',
                'empty_data' => true,
                'placeholder' => '-- Choose vacation types --',
                'attr' => [
                    'class' => 'form-control',
                ],
                'label_attr' => [],
                'required' => false,
            ])
            ->add('department', EntityType::class, [
                'class' => CompanyDepartment::class,
                'choice_label' => 'title',
                'empty_data' => true,
                'placeholder' => '-- Choose department --',
                'attr' => [
                    'class' => 'form-control',
                ],
                'label_attr' => [],
                'required' => false,
            ])
        ;
    }
}

?>
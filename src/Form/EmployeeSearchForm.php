<?php

namespace App\Form;
;

use App\Entity\CompanyDepartment;
use App\Entity\VacationType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmployeeSearchForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('search', TextType::class, [
                //'empty_data' => true,
                'attr' => [
                    'class' => 'form-control form-control-sm',
                    'placeholder' => 'Search ...',
                ],
                'label_attr' => [],
                'required' => false,
            ])
            ->add('type', EntityType::class, [
                'class' => VacationType::class,
                'choice_label' => 'title',
                'empty_data' => '',
                'placeholder' => '-- Choose vacation types --',
                'attr' => [
                    'class' => 'form-control form-control-sm',
                ],
                'label_attr' => [],
                'required' => false,
            ])
            ->add('department', EntityType::class, [
                'class' => CompanyDepartment::class,
                'choice_label' => 'title',
                'empty_data' => '',
                'placeholder' => '-- Choose department --',
                'attr' => [
                    'class' => 'form-control form-control-sm',
                ],
                'label_attr' => [],
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'attr' => [
                'class' => 'form-inline',
            ],
        ]);
    }
}

?>
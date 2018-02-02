<?php

namespace App\Form\System;

use App\Entity\Company;
use App\Repository\CompanyRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class CompanyForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Company title',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('registrationNo', TextType::class, [
                'required' => false,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('parent', EntityType::class, [
                'required' => false,
                'class' => Company::class,
                'query_builder' => function (CompanyRepository $er) {
                    return $er->getSelectList();
                },
                'choice_label' => 'title',
                'placeholder' => '-- Select parent --',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Company::class,
        ));
    }
}

?>
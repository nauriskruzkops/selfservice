<?php

namespace App\Form\System;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use App\Entity\Vacation;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class,[
                'attr' => ['class' => 'form-control'],
                'required' => false,
            ])
            ->add('password', PasswordType::class,[
                'attr' => ['class' => 'form-control'],
                'required' => false,
            ])
            ->add('active', CheckboxType::class,[
                'attr' => [],
                'required' => false,
            ])
            ->add('roles', ChoiceType::class, [
                'required' => false,
                'mapped' => true,
                'expanded' => true,
                'multiple' => true,
                'choices' => array_flip(User::ROLES_ALL),
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
        ));
    }
}

?>
<?php

namespace App\Controller\Calendar;

use App\Entity\Employee;
use App\Entity\Vocation;
use App\Repository\EmployeeRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class VocationController extends Controller
{
    /**
     * @Route("/calendar/add", name="calendar_add_post")
     */
    public function addAction(Request $request)
    {
        $form = $this->vocationForm($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $vocation = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($vocation);
            $em->flush();

            return $this->redirectToRoute('task_success');
        }


        return $this->render('calendar/index.html.php', [
            'form' => $form->createView(),
        ]);
    }

    protected function vocationForm(Request $request)
    {
        $vocation = new Vocation();
        $form = $this->createFormBuilder($vocation)
            ->add('type', ChoiceType::class, array(
                'choice_translation_domain' => null,
                'choices'  => Vocation::TYPES,
            ))
            ->add('employee', EntityType::class, array(
                'class' => Employee::class,
                'query_builder' => function (EmployeeRepository $er) {
                    return $er->getSelectList();
                },
                'choice_label' => 'fullName',
            ))

            ->add('startDate', DateType::class)
            ->add('endDate', DateType::class)
            ->add('save', SubmitType::class, array('label' => 'Add vocation'))
            ->getForm();

        $form->handleRequest($request);

        return $form;
    }
}
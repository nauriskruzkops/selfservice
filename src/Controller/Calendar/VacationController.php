<?php

namespace App\Controller\Calendar;

use App\Entity\Employee;
use App\Entity\Vacation;
use App\Form\CalendarVacationForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class VacationController extends Controller
{

    /**
     * AJAX request
     * @Route("/calendar/vacation/{id}/info", name="vacation_info")
     */
    public function editAction(Request $request)
    {
        /** @var Vacation $vacation */
        $vacation = $this->getDoctrine()->getRepository(Vacation::class)->find($request->get('id'));

        /** @var CalendarVacationForm $form */
        $form = $this->createForm(CalendarVacationForm::class, $vacation, [
            'action' => $this->generateUrl('vacation_info', ['id' => $vacation->getId()]),
            'method' => 'POST',
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $em = $this->getDoctrine()->getManager();
                $em->merge($form->getData());
                $em->flush();

                return $this->json([
                    'status' => 'OK'
                ]);
            } catch (\Exception $e) {
                return $this->json([
                    'status' => 'ERROR'
                ]);
            }

        }

        if ($request->isXmlHttpRequest()) {
            return $this->render('calendar/partial/vacation_manage_form.html.php', [
                'form' => $form->createView(),
                'vacation' => $vacation,
            ]);
        }
    }

    /**
     * HTML & AJAX request
     * @Route("/calendar/vacation/add", name="vacation_add")
     */
    public function addAction(Request $request)
    {
        /** @var CalendarVacationForm $form */
        $form = $this->createForm(CalendarVacationForm::class, new Vacation(), [
            'action' => $this->generateUrl('vacation_add'),
            'method' => 'POST',
        ]);

        /** @var Employee $employee */
        if (($employee = $request->get('employee', null))) {
            $form->get('employee')
                ->setData($this->getDoctrine()->getRepository(Employee::class)->find($employee))
            ;
            //$form->get('employee')->setAttributes(['readonly' => 'readonly']);
        }

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $em = $this->getDoctrine()->getManager();
                $em->persist($form->getData());
                $em->flush();

                return $this->json([
                    'status' => 'OK'
                ]);
            } catch (\Exception $e) {
                return $this->json([
                    'status' => 'ERROR'
                ]);
            }

        }

        if ($request->isXmlHttpRequest()) {
            return $this->render('calendar/partial/vacation_manage_form.html.php', [
                'form' => $form->createView(),
                'vacation' => null,
            ]);
        }

        return $this->render('calendar/index.html.php', [
            'startDate' => (new \DateTime('now'))->modify('first day of this month'),
            'form' => $form->createView(),
        ]);
    }

    /**
     * AJAX request
     * @Route("/calendar/vacation/{id}/add", name="vacation_delete")
     */
    public function deleteAction(Request $request)
    {
        return $this->json([
            'status' => 'OK'
        ]);
    }
}
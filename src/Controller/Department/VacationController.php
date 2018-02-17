<?php

namespace App\Controller\Department;

use App\Controller\ExtendController;
use App\Entity\Employee;
use App\Entity\Vacation;
use App\Form\EmployeeVacationForm;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class VacationController extends ExtendController
{

    /**
     * AJAX request
     * @Route("/employee/{employee_id}/vacation/{vacation_id}/info", name="employee_vacation_info")
     */
    public function editAction(Request $request)
    {
        $employee = $this->getEmployeeBy($request);

        /** @var Vacation $vacation */
        $vacation = $this->getDoctrine()->getRepository(Vacation::class)->find($request->get('vacation_id'));

        /** @var EmployeeVacationForm $form */
        $form = $this->createForm(EmployeeVacationForm::class, $vacation, [
            'action' => $this->generateUrl('employee_vacation_info', [
                'employee_id' => $vacation->getEmployee()->getId(),
                'vacation_id' => $vacation->getId(),
            ]),
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
                'employee' => $employee,
            ]);
        }
    }

    /**
     * HTML & AJAX request
     * @Route("/employee/{employee_id}/vacation/add", name="employee_vacation_add")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request)
    {
        /** @var EmployeeVacationForm $form */
        $form = $this->createForm(EmployeeVacationForm::class, new Vacation(), [
            'action' => $this->generateUrl('employee_vacation_add',[
                'employee_id' => $request->get('employee_id')
            ]),
            'method' => 'POST',
        ]);

        /** @var Employee $employee */
        $employee = $this->getEmployeeBy($request);

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
                'employee' => $employee,
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
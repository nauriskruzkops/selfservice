<?php

namespace App\Controller\Calendar;

use App\Entity\Employee;
use App\Entity\Vocation;
use App\Form\CalendarVocationForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class VocationController extends Controller
{

    /**
     * AJAX request
     * @Route("/calendar/vocation/{id}/info", name="vocation_info")
     */
    public function editAction(Request $request)
    {
        /** @var Vocation $vocation */
        $vocation = $this->getDoctrine()->getRepository(Vocation::class)->find($request->get('id'));

        /** @var CalendarVocationForm $form */
        $form = $this->createForm(CalendarVocationForm::class, $vocation, [
            'action' => $this->generateUrl('vocation_info', ['id' => $vocation->getId()]),
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
            return $this->render('calendar/partial/vocation_manage_form.html.php', [
                'form' => $form->createView(),
                'vocation' => $vocation,
            ]);
        }
    }

    /**
     * HTML & AJAX request
     * @Route("/calendar/vocation/add", name="vocation_add")
     */
    public function addAction(Request $request)
    {
        /** @var CalendarVocationForm $form */
        $form = $this->createForm(CalendarVocationForm::class, new Vocation(), [
            'action' => $this->generateUrl('vocation_add'),
            'method' => 'POST',
        ]);

        /** @var Employee $employee */
        if (($employee = $request->get('employee', null))) {
            $form->get('employee')->setData($this->getDoctrine()->getRepository(Employee::class)->find($employee));
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
            return $this->render('calendar/partial/vocation_manage_form.html.php', [
                'form' => $form->createView(),
            ]);
        }

        return $this->render('calendar/index.html.php', [
            'startDate' => (new \DateTime('now'))->modify('first day of this month'),
            'form' => $form->createView(),
        ]);
    }

    /**
     * AJAX request
     * @Route("/calendar/vocation/{id}/add", name="vocation_delete")
     */
    public function deleteAction(Request $request)
    {
        return $this->json([
            'status' => 'OK'
        ]);
    }
}
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
     * @Route("/calendar/vocation/add", name="vocation_add")
     */
    public function addFormAction(Request $request)
    {

        $employee = $request->get('employee', null);
        $entity = new Vocation();
        if ($employee) {
            $entity->setEmployee($this->getDoctrine()->getRepository(Employee::class)->find($employee));
        }

        $form = $this->createForm(CalendarVocationForm::class, $entity, [
            'action' => $this->generateUrl('vocation_add'),
            'method' => 'POST',
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $em = $this->getDoctrine()->getManager();
                $em->persist($entity);
                $em->flush();

                return $this->json([
                    'status' => 'OK'
                ]);
            } catch (\Exception $e) {
                var_dump($entity);

                return $this->json([
                    'status' => 'ERROR',
                    'message' => $e->getMessage()
                ]);
            }
        }

        return $this->render('calendar/partial/vocation_manage_form.html.php',[
            'form' => $form->createView(),
        ]);
    }
}
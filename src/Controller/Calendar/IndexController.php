<?php

namespace App\Controller\Calendar;

use App\Entity\Employee;
use App\Form\CalendarVocationForm;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends VocationController
{
    /**
     * @Route("/calendar", name="calendar")
     */
    public function indexAction(Request $request)
    {
        $employees = $this->getDoctrine()->getRepository(Employee::class)->getList();
        $form = $this->createForm(CalendarVocationForm::class);

        return $this->render('calendar/index.html.php', [
            'startDate' => (new \DateTime('now'))->modify('first day of this month'),
            'employees' => $employees,
            'form' => $form->createView(),
        ]);
    }

}
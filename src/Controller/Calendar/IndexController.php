<?php

namespace App\Controller\Calendar;

use App\Entity\CompanyEmployee;
use App\Form\CalendarVacationForm;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends VacationController
{
    /**
     * @Route("/calendar", name="calendar")
     */
    public function indexAction(Request $request)
    {
        $employees = $this->getDoctrine()->getRepository(CompanyEmployee::class)->getListByDepartments();
        $form = $this->createForm(CalendarVacationForm::class);

        return $this->render('calendar/index.html.php', [
            'startDate' => (new \DateTime('now'))->modify('first day of this month'),
            'employees' => $employees,
            'form' => $form->createView(),
        ]);
    }

}
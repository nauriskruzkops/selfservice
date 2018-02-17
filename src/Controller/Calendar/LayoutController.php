<?php

namespace App\Controller\Calendar;

use App\Controller\ExtendController;
use App\Entity\CompanyEmployee;
use App\Service\CalendarGenerator;
use Symfony\Component\HttpFoundation\Request;

class LayoutController extends ExtendController
{
    public function calendar(CalendarGenerator $calendarGenerator, Request $request)
    {
        $getDate = $request->get('date', new \DateTime('now'));
        if (!$getDate instanceof \DateTime) {
            $getDate = new \DateTime($getDate);
        }

        $employees = $this->getDoctrine()->getRepository(CompanyEmployee::class)->getListByDepartments();

        return $this->render('calendar/partial/calendar.html.php', [
            'icon' => 'fa fa-fw fa-calendar',
            'title' => 'Days timeline',
            'footer' => null,
            'employees' => $employees,
            'startDate' => clone $getDate->modify('first day of this month'),
            'calendar' => $calendarGenerator->generate($getDate),
        ]);
    }

}
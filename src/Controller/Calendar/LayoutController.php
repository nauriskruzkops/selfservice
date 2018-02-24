<?php

namespace App\Controller\Calendar;

use App\Controller\ExtendController;
use App\Entity\CompanyDepartment;
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

        $getEmployeesBy = $request->get('getEmployeesBy');

        if ($getEmployeesBy instanceof CompanyDepartment) {
            $employees = $this->getDoctrine()->getRepository(CompanyEmployee::class)->getListByDepartments($getEmployeesBy);
        } else {
            $department = $this->getDepartmentByUser($this->getUser());
            if ($department instanceof CompanyDepartment ) {
                $employees = $this->getDoctrine()->getRepository(CompanyEmployee::class)->getListByDepartments($department);
            } else {
                $employees = null;
            }
        }

        return $this->render('calendar/partial/calendar.html.php', [
            'employees' => $employees,
            'startDate' => clone $getDate->modify('first day of this month'),
            'calendar' => $calendarGenerator->generate($getDate),
        ]);
    }

}
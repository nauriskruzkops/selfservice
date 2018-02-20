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
     * @Route("/department/{department_id}/vacations/", name="department_vacations")
     */
    public function indexAction(Request $request)
    {
        $employee = $this->getEmployeeByUser($this->getUser());
        if (($departmentId = $request->get('department_id', null))) {
            $department = $this->getDepartmentBy($departmentId);
        } else {
            $department = $this->getDepartmentByUser($this->getUser());
        }

        return $this->render('department/vacation.html.php', [
            'department' => $department,
            'employee' => $employee,
        ]);
    }
}
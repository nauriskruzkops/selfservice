<?php

namespace App\Controller\Employee;

use App\Controller\ExtendController;
use App\Entity\Employee;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EmployeeController extends ExtendController
{

    /**
     * @Route("/employee", name="employee")
     */
    public function indexAction(Request $request)
    {
        /** @var Employee $employee */
        $employee = $this->getUser()->getEmployee();

        return $this->render('employee/overview.html.php', [
            'employee' => $employee
        ]);
    }

    /**
     * @Route("/employee/{employee_id}", name="employee_id")
     */
    public function idAction(Request $request)
    {
        $employee = $this->getDepartmentBy($request->get('employee_id'));

        return $this->render('department/overview.html.php', [
            'employee' => $employee
        ]);
    }
}
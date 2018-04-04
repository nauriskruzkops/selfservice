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

        $response = $this->forward('App\Controller\Employee\EmployeeController::idAction', [
            'request'  => $request,
            'employee'  => $employee,
        ]);

        return $response;
    }

    /**
     * @Route("/employee/{employee_id}", name="employee_id")
     */
    public function idAction(Request $request, $employee = null)
    {
        /** @var Employee $employee */
        $employee = $employee ?? $this->getEmployeeBy($request);

        return $this->render('employee/overview.html.php', [
            'employee' => $employee
        ]);
    }
}
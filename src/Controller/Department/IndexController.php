<?php

namespace App\Controller\Department;

use App\Controller\ExtendController;
use App\Entity\CompanyEmployee;
use App\Entity\Employee;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends ExtendController
{
    /**
     * @Route("/department", name="department")
     */
    public function indexAction(Request $request)
    {
        /** @var CompanyEmployee $employee */
        $employee = $this->getUser()->getEmployee()->getCompanyRelation()->first();
        $department = $employee->getDepartment();

        return $this->render('department/overview.html.php', [
            'department' => $department,
            'employee' => $employee,
        ]);
    }

    /**
     * @Route("/department/{department_id}", name="department_id")
     */
    public function idAction(Request $request)
    {
        $department = $this->getDepartmentBy($request->get('department_id'));

        return $this->render('department/overview.html.php', [
            'department' => $department
        ]);
    }
}
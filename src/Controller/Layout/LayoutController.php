<?php

namespace App\Controller\Layout;

use App\Controller\ExtendController;
use Symfony\Component\HttpFoundation\Request;

class LayoutController extends ExtendController
{
    public function departmentsDropdown(Request $request, array $params = [])
    {

        $employee = $this->getEmployeeByUser($this->getUser());

        if (($departmentId = $request->get('department_id', null))) {
            $department = $this->getDepartmentBy($departmentId);
        } else {
            $department = $this->getDepartmentByUser($this->getUser());
        }

        $company = $employee->getCompany();

        return $this->render('layout/partial/departments-dropdown.html.php', [
            'current' => $department,
            'departments' => $company->getDepartments(),
        ]);
    }
}
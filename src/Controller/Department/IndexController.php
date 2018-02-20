<?php

namespace App\Controller\Department;

use App\Controller\ExtendController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends ExtendController
{
    /**
     * @Route("/department/{department_id}", name="department", defaults={"department_id"=""})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function idAction(Request $request)
    {
        $employee = $this->getEmployeeByUser($this->getUser());
        if (($departmentId = $request->get('department_id', null))) {
            $department = $this->getDepartmentBy($departmentId);
        } else {
            $department = $this->getDepartmentByUser($this->getUser());
        }

        return $this->render('department/overview.html.php', [
            'department' => $department,
            'employee' => $employee,
        ]);
    }
}
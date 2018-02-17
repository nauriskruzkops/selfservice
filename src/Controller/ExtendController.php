<?php

namespace App\Controller;

use App\Entity\CompanyDepartment;
use App\Entity\Employee;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ExtendController extends Controller
{
    /**
     * @param int|Request $id
     * @return Employee|\Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function getEmployeeBy($id)
    {
        if ($id instanceof Request) {
            $findBy = $id->get('employee_id');
        } else {
            $findBy = $id;
        }

        if (is_numeric($id) && !empty($findBy)) {
            /** @var Employee $employee */
            if (($employee = $this->getDoctrine()->getRepository(Employee::class)->find($findBy))) {
                return $employee;
            }
        }

        return $this->createNotFoundException();
    }

    /**
     * @param int|Request $id
     * @return CompanyDepartment|\Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function getDepartmentBy($id)
    {
        if ($id instanceof Request) {
            $findBy = $id->get('department_id');
        } else {
            $findBy = $id;
        }

        if (is_numeric($id) && !empty($findBy)) {
            /** @var CompanyDepartment $department */
            if (($department = $this->getDoctrine()->getRepository(CompanyDepartment::class)->find($findBy))) {
                return $department;
            }
        }

        return $this->createNotFoundException();
    }

}
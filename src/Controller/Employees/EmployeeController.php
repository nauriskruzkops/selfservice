<?php

namespace App\Controller\Employees;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EmployeeController extends Controller
{

    /**
     * @Route("/employees", name="employees")
     */
    public function indexAction(Request $request)
    {
        return $this->render('employees/employee.html.php', [
            'name' => 'Me!'
        ]);
    }
}
<?php

namespace App\Controller\Employees;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CompanyController extends Controller
{

    /**
     * @Route("/companies", name="companies")
     */
    public function indexAction(Request $request)
    {
        return $this->render('employees/employee.html.php', [
            'name' => 'Me!'
        ]);
    }
}
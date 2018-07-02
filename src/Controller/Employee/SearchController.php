<?php

namespace App\Controller\Employee;

use App\Controller\ExtendController;
use App\Entity\EmployeeDepartments;
use App\Form\EmployeeSearchForm;
use App\Repository\EmployeeDepartmentsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends ExtendController
{
    /**
     * @Route("/employees", name="employees")
     */
    public function listAction(Request $request)
    {
        $filterSearchForm = $this->createForm(EmployeeSearchForm::class);
        $filterSearchForm->handleRequest($request);

        /** @var EmployeeDepartmentsRepository $repositoey */
        $repositoey = $this->getDoctrine()->getRepository(EmployeeDepartments::class);
        $employees = $repositoey->serachByFilterForm($filterSearchForm->getData(), null);

        return $this->render('employee/list.html.php', [
            'employees' => $employees,
        ]);
    }

    public function filter(Request $request = null)
    {
        $form = $this->createForm(EmployeeSearchForm::class);
        $form->handleRequest($request);

        return $this->render('employee/partial/filter_form.html.php', [
            'form' => $form->createView(),
        ]);
    }

    public function list(Request $request = null)
    {
        $form = $this->createForm(EmployeeSearchForm::class);
        $form->handleRequest($request);

        /** @var EmployeeDepartmentsRepository $repositoey */
        $repositoey = $this->getDoctrine()->getRepository(EmployeeDepartments::class);
        $employees = $repositoey->serachByFilterForm($form->getData(), null);

        return $this->render('employee/partial/list.html.php', [
            'employees' => $employees,
        ]);
    }
}
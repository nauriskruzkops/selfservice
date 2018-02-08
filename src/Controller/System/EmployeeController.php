<?php

namespace App\Controller\System;

use App\Entity\Company;
use App\Entity\CompanyEmployee;
use App\Entity\Employee;
use App\Form\System\EmployeeForm;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EmployeeController extends ExtendController
{
    /**
     * @Route("/system/employee/{id}", name="system_employee", requirements={"id"="\d+"})
     */
    public function indexAction($id)
    {
        if(!($employee = $this->getDoctrine()->getRepository(Employee::class)->find($id))){
            return $this->redirectToRoute('system');
        }

        /** @var EmployeeForm $form */
        $form = $this->createForm(EmployeeForm::class, $employee, [
            'action' => $this->generateUrl('vacation_info', ['id' => $employee->getId()]),
            'method' => 'POST',
        ]);

        $company = null;
        if ($employee->getCompanyRelation()) {
            $company = $employee->getCompanyRelation()->last()->getCompany();
        }

        return $this->render('system/employee.html.php', [
            'company' => $company,
            'employee' => $employee,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/system/company/{id}/employee/add", name="system_employee_add", requirements={"id"="\d+"})
     */
    public function addAction($id, Request $request)
    {
        $employee = new Employee();
        if (($company = $this->getDoctrine()->getRepository(Company::class)->find($id))){
            $relation = new CompanyEmployee();
            $relation->setCompany($company);
            $employee->addCompanyRelation($relation);
        }

        /** @var EmployeeForm $form */
        $form = $this->createForm(EmployeeForm::class, $employee, [
            'action' => $this->generateUrl('system_employee_add', ['id' => $company->getId()]),
            'method' => 'POST',
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $em = $this->getDoctrine()->getManager();
                $em->persist($form->getData());
                $em->flush();

                $this->addFlash(
                    'notice',
                    'Your changes were saved!'
                );

                return $this->redirectToRoute('system_employee_edit', ['id' => $employee->getId()]);
            } catch (\Exception $e) {
                var_dump($e);
            }
        }

        return $this->render('system/employee.html.php', [
            'company' => $company,
            'employee' => $employee,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/system/employee/{id}/edit", name="system_employee_edit", requirements={"id"="\d+"})
     */
    public function editAction($id, Request $request)
    {
        /** @var Employee $employee */
        if(!($employee = $this->getDoctrine()->getRepository(Employee::class)->find($id))){
            return $this->redirectToRoute('system');
        }

        /** @var EmployeeForm $form */
        $form = $this->createForm(EmployeeForm::class, $employee, [
            'action' => $this->generateUrl('system_employee_edit', ['id' => $employee->getId()]),
            'method' => 'POST',
        ]);

        $company = null;
        if ($employee->getCompanyRelation()) {
            $company = $employee->getCompanyRelation()->last()->getCompny();
        }

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $em = $this->getDoctrine()->getManager();
                $em->merge($form->getData());
                $em->flush();

                $this->addFlash(
                    'notice',
                    'Your changes were saved!'
                );

                return $this->redirectToRoute('system_employee', ['id' => $employee->getId()]);
            } catch (\Exception $e) {
                var_dump($e);
            }
        }

        return $this->render('system/employee.html.php', [
            'company' => $company,
            'employee' => $employee,
            'form' => $form->createView(),
        ]);
    }

}
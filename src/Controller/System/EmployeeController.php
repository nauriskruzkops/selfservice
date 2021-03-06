<?php

namespace App\Controller\System;

use App\Entity\Company;
use App\Entity\EmployeeDepartments;
use App\Entity\Employee;
use App\Form\System\EmployeeForm;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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
            'action' => $this->generateUrl('system_employee_edit', ['id' => $employee->getId()]),
            'method' => 'POST',
        ]);

        $company = null;
        if ($employee->getCompany()) {
            $company = $employee->getCompany();
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
            $department = new EmployeeDepartments();
            $department->setEmployee($employee);
            $employee->addDepartment($department);
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
    public function editAction($id, UserPasswordEncoderInterface $encoder, Request $request)
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
        if ($employee->getDepartments()) {
            $company = $employee->getDepartments()->last()->getCompany();
        }

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                try {
                    /** @var Employee $employee */
                    $employee = $form->getData();
                    $em = $this->getDoctrine()->getManager();
                    $em->merge($form->getData());
                    $em->flush();

                    $this->addFlash(
                        'notice',
                        'Your changes were saved!'
                    );

                    return $this->redirectToRoute('system_employee', ['id' => $employee->getId()]);
                } catch (\Exception $e) {
                    // ToDo: Error logging
                    // Temp
                    $this->addFlash('error', $e->getMessage());
                }
            } else {
                $this->addFlash(
                    'error',
                    $form->getErrors()->current()->getMessage()
                );
            }
        }

        return $this->render('system/employee.html.php', [
            'company' => $company,
            'employee' => $employee,
            'form' => $form->createView(),
        ]);
    }

}
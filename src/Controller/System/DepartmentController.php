<?php

namespace App\Controller\System;

use App\Entity\CompanyDepartment;
use App\Form\System\DepartmentForm;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DepartmentController extends ExtendController
{
    public function list($company, Request $request)
    {
        /** @var Company $company */
        $company = $request->get('company');
        $departments = $this->getDoctrine()
            ->getRepository(CompanyDepartment::class)
            ->getPaginateList($company);

        return $this->render('system/partial/departments-list.html.php', [
            'icon' => 'fa fa-fw fa-users',
            'title' => 'Departments list',
            'company' => $company,
            'departments' => $departments,
        ]);
    }

    /**
     * @Route("/system/department/{id}/edit", name="system_department_edit", requirements={"id"="\d+"})
     */
    public function editAction($id, Request $request)
    {
        /** @var CompanyDepartment $employee */
        if(!($department = $this->getDoctrine()->getRepository(CompanyDepartment::class)->find($id))){
            return $this->redirectToRoute('system');
        }

        /** @var EmployeeForm $form */
        $form = $this->createForm(DepartmentForm::class, $department, [
            'action' => $this->generateUrl('vocation_info', ['id' => $department->getId()]),
            'method' => 'POST',
        ]);

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

        return $this->render('system/department.html.php', [
            'department' => $department,
            'form' => $form->createView(),
        ]);
    }
}
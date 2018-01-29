<?php

namespace App\Controller\System;

use App\Entity\Company;
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
     * @Route("/system/company/{id}/department/add", name="system_department_add")
     */
    public function addAction($id, Request $request)
    {
        $department = new CompanyDepartment();
        if(($company = $this->getDoctrine()->getRepository(Company::class)->find($id))){
            $department->setCompany($company);
        }

        /** @var DepartmentForm $form */
        $form = $this->createForm(DepartmentForm::class, $department, [
            'action' => $this->generateUrl('system_department_add', ['id' => $company ? $company->getId() : 0]),
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

                return $this->redirectToRoute('system_department_edit', ['id' => $department->getId()]);
            } catch (\Exception $e) {
                var_dump($e);
            }
        }

        return $this->render('system/department.html.php', [
            'company' => $company,
            'department' => $department,
            'form' => $form->createView(),
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

        /** @var DepartmentForm $form */
        $form = $this->createForm(DepartmentForm::class, $department, [
            'action' => $this->generateUrl('system_department_edit', ['id' => $department->getId()]),
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

                return $this->redirectToRoute('system_department_edit', ['id' => $department->getId()]);
            } catch (\Exception $e) {
                var_dump($e);
            }
        }

        return $this->render('system/department.html.php', [
            'department' => $department,
            'company' => $department->getCompany(),
            'form' => $form->createView(),
        ]);
    }
}
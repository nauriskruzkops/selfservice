<?php

namespace App\Controller\System;

use App\Entity\Company;
use App\Form\System\CompanyForm;
use App\Entity\EmployeeDepartments;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CompanyController extends ExtendController
{
    public function list(Request $request)
    {
        $companies = $this->getDoctrine()->getRepository(Company::class)->getList();

        return $this->render('system/partial/company-list.html.php', [
            'companies' => $companies
        ]);
    }

    public function employees(Request $request)
    {
        /** @var Company $company */
        $company = $request->get('company');
        $employees = $this->getDoctrine()
            ->getRepository(EmployeeDepartments::class)
            ->getPaginateList($company);

        return $this->render('system/partial/employees-list.html.php', [
            'icon' => 'fa fa-fw fa-users',
            'title' => 'Employees list',
            'company' => $company,
            'employees' => $employees,
        ]);
    }

    /**
     * @Route("/system/company/add", name="system_company_add")
     */
    public function addAction(Request $request)
    {
        $company = new Company();

        /** @var CompanyForm $form */
        $form = $this->createForm(CompanyForm::class, $company, [
            'action' => $this->generateUrl('system_company_add', ['id' => $company->getId()]),
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

                return $this->redirectToRoute('system_company_edit', ['id' => $company->getId()]);
            } catch (\Exception $e) {
                //var_dump($e);
                $this->addFlash(
                    'error',
                    'Something wrong, data was not saved'
                );
            }
        }

        return $this->render('system/company.html.php', [
            'form' => $form,
            'company' => $company,
        ]);
    }

    /**
     * @Route("/system/company/{id}/edit", name="system_company_edit", requirements={"id"="\d+"})
     */
    public function editAction(Request $request, $id)
    {
        if(!($company = $this->getDoctrine()->getRepository(Company::class)->find($id))){
            return $this->redirectToRoute('system');
        }

        /** @var CompanyForm $form */
        $form = $this->createForm(CompanyForm::class, $company, [
            'action' => $this->generateUrl('system_company_edit', ['id' => $company->getId()]),
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

                return $this->redirectToRoute('system_company_edit', ['id' => $company->getId()]);
            } catch (\Exception $e) {
                //var_dump($e);
                $this->addFlash(
                    'error',
                    'Something wrong, data was not saved'
                );
            }
        }

        return $this->render('system/company.html.php', [
            'form' => $form,
            'company' => $company,
        ]);
    }
}
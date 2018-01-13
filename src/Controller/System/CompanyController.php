<?php

namespace App\Controller\System;

use App\Entity\Company;
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

        return $this->render('system/partial/employees-list.html.php', [
            'icon' => 'fa fa-fw fa-users',
            'title' => 'Employees list',
            'company' => $company
        ]);
    }

    /**
     * @Route("/system/company/{id}/edit", name="system_company_edit", requirements={"id"="\d+"})
     */
    public function editAction($id)
    {
        if(!($company = $this->getDoctrine()->getRepository(Company::class)->find($id))){
            return $this->redirectToRoute('system');
        }

        return $this->render('system/company.html.php', [
            'company' => $company
        ]);
    }
}
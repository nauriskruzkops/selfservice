<?php

namespace App\Controller\Employee;

use App\Controller\ExtendController;
use App\Form\EmployeeSearchForm;
use Symfony\Component\HttpFoundation\Request;

class SearchController extends ExtendController
{

    public function filter(Request $request = null)
    {
        $form = $this->createForm(EmployeeSearchForm::class);
        $form->handleRequest($request);

        return $this->render('employee/partial/filter_form.html.php', [
            'form' => $form->createView(),
        ]);
    }
}
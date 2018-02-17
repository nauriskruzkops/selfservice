<?php

namespace App\Controller\Calendar;

use App\Controller\ExtendController;
use App\Entity\CompanyEmployee;
use App\Form\EmployeeVacationForm;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends ExtendController
{
    /**
     * @Route("/calendar", name="calendar")
     */
    public function indexAction(Request $request)
    {
        $employees = $this->getDoctrine()->getRepository(CompanyEmployee::class)->getListByDepartments();
        $form = $this->createForm(EmployeeVacationForm::class);

        return $this->render('calendar/index.html.php', [
            'startDate' => (new \DateTime('now'))->modify('first day of this month'),
            'employees' => $employees,
            'form' => $form->createView(),
        ]);
    }

}
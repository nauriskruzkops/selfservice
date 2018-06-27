<?php

namespace App\Controller\Calendar;

use App\Controller\ExtendController;
use App\Entity\EmployeeDepartments;
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
        try {
            $department = $this->getEmployeeByUser($this->getUser());
        } catch (\Exception $e) {
            // ToDo: Log error
            $department = null;
        }

        $employees = $this->getDoctrine()->getRepository(EmployeeDepartments::class)->findAll();

        $form = $this->createForm(EmployeeVacationForm::class);
        return $this->render('calendar/index.html.php', [
            'startDate' => (new \DateTime('-3 month'))->modify('first day of this month'),
            'department' => $department,
            'form' => $form->createView(),
            'employees' => $employees,
        ]);
    }

}
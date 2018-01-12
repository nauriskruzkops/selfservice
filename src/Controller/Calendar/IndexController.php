<?php

namespace App\Controller\Calendar;

use App\Entity\Employee;
use App\Entity\Vocation;
use App\Service\VocationRender;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends Controller
{
    /**
     * @Route("/calendar", name="calendar")
     */
    public function indexAction(Request $request)
    {
        $employees = $this->getDoctrine()->getRepository(Employee::class)->getList();

        return $this->render('calendar/index.html.php', [
            'startDate' => (new \DateTime('now'))->modify('first day of this month'),
            'employees' => $employees,
        ]);
    }

}
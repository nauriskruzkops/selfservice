<?php

namespace App\Controller\Calendar;

use App\Service\CalendarGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class LayoutController extends Controller
{
    public function calendar(CalendarGenerator $calendarGenerator, Request $request)
    {
        $getDate = $request->get('date', new \DateTime('now'));
        if (!$getDate instanceof \DateTime) {
            $getDate = new \DateTime($getDate);
        }

        return $this->render('calendar/partial/calendar.html.php', [
            'icon' => 'fa fa-fw fa-calendar',
            'title' => 'Days timeline',
            'footer' => null,
            'calendar' => $calendarGenerator->generate($getDate),
        ]);
    }

}
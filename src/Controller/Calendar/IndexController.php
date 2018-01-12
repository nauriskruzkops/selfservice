<?php

namespace App\Controller\Calendar;

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
        $vocations = $this->getDoctrine()->getRepository(Vocation::class)->findAll();

        return $this->render('calendar/index.html.php', [
            'vocations' => $vocations
        ]);
    }

}
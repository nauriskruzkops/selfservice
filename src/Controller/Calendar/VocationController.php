<?php

namespace App\Controller\Calendar;

use App\Form\CalendarVocationForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class VocationController extends Controller
{
    /**
     * @Route("/calendar/add", name="calendar_add_post")
     */
    public function addAction(Request $request)
    {
        $form = $this->createForm(CalendarVocationForm::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $vocation = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($vocation);
            $em->flush();

            return $this->redirectToRoute('task_success');
        }

        return $this->render('calendar/index.html.php', [
            'form' => $form->createView(),
        ]);
    }
}
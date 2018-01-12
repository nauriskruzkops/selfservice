<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class FirstpageController extends Controller
{

    /**
     * @Route("/", name="root")
     */
    public function indexAction()
    {
        return $this->redirectToRoute('dashboard');
    }
}
<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FirstpageController extends Controller
{

    /**
     * @Route("/", name="root")
     */
    public function indexAction(Request $request)
    {
        $response = $this->forward('App\Controller\Dashboard\IndexController::indexAction', [
            'request' => $request
        ]);

        return $response;
    }
}
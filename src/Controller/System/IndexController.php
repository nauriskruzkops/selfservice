<?php

namespace App\Controller\System;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends ExtendController
{
    /**
     * @Route("/system", name="system")
     */
    public function indexAction(Request $request)
    {
        return $this->render('system/index.html.php', [
            'pageTitle' => 'System settings'
        ]);
    }
}
<?php

namespace App\Controller\Dashboard;

use App\Controller\ExtendController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends ExtendController
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function indexAction(Request $request)
    {
        return $this->render('dashboard/index.html.php', [
            'name' => 'Me!'
        ]);
    }
}
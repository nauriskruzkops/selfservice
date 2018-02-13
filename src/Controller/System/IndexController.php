<?php

namespace App\Controller\System;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends ExtendController
{
    /**
     * @Route("/system", name="system")
     */
    public function indexAction(Request $request)
    {
        if (!$this->isGranted(User::ROLE_ADMIN)) {
            $this->denyAccessUnlessGranted('view');
        }

        return $this->render('system/index.html.php', [
            'pageTitle' => 'System settings'
        ]);
    }
}
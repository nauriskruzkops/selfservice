<?php

namespace App\Controller\Layout;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class NavigationController extends Controller
{

    public function navigation(Request $request)
    {
        return $this->render('layout/partial/navigation.html.php', [
            'request' => $request
        ]);
    }

    public function breadcrumb(array $params = [])
    {
        return $this->render('layout/partial/breadcrumb.html.php', $params);
    }
}
<?php

namespace App\Controller\Layout;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NavigationController extends Controller
{

    public function navigation($_parent = null)
    {
        return $this->render('layout/partial/navigation.html.php', [
            '_parent' => $_parent
        ]);
    }

    public function breadcrumb(array $params = [])
    {
        return $this->render('layout/partial/breadcrumb.html.php', $params);
    }
}
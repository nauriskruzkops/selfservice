<?php

namespace App\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends Controller
{

    /**
     * @Route("/profile", name="user_profile")
     */
    public function loginAction(Request $request)
    {
        return $this->render('user/login.html.php', [
            'name' => 'Me!'
        ]);
    }
}
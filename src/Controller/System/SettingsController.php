<?php

namespace App\Controller\System;

use App\Service\SettingsService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SettingsController extends ExtendController
{
    public function companyList($company, SettingsService $service, Request $request)
    {
        return $this->render('system/partial/setting-list.html.php', [
            'pageTitle' => 'System settings'
        ]);
    }
}
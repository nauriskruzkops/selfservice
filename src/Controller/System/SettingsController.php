<?php

namespace App\Controller\System;

use App\Service\SettingsService;
use Symfony\Component\HttpFoundation\Request;

class SettingsController extends ExtendController
{
    public function companyList($company, SettingsService $service, Request $request)
    {
        return $this->render('system/partial/setting-list.html.php', [
            'pageTitle' => 'System settings'
        ]);
    }
}
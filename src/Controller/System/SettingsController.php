<?php

namespace App\Controller\System;

use App\Entity\Settings;
use App\Service\SettingsService;
use Symfony\Component\HttpFoundation\Request;

class SettingsController extends ExtendController
{
    public function globalList(SettingsService $service, Request $request)
    {
        return $this->render('system/partial/setting-list.html.php', [
            'settings' => $service->getList(),
            'settingsArray' => $service->getKeyValueList()
        ]);
    }

    public function companyList($company, SettingsService $service, Request $request)
    {
        $service->setCompany($company);

        return $this->render('system/partial/setting-list.html.php', [
            'settings' => $service->getList()
        ]);
    }
}
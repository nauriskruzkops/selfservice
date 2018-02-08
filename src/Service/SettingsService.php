<?php

namespace App\Service;

use App\Entity\Company;
use App\Entity\Settings;
use Doctrine\ORM\EntityManager;

class SettingsService
{
    /** @var Company */
    private $company;

    /** @var EntityManager  */
    private $em;

    /**
     * SettingsService constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @return mixed
     */
    private function getCompany():? Company
    {
        return $this->company;
    }

    /**
     * @param Company $company
     * @return SettingsService
     */
    public function setCompany(Company $company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return Settings[]
     */
    public function getList()
    {
        $settingsGlobal = $this->em->getRepository(Settings::class)->getGlobalList();

        if (($company = $this->getCompany())) {
            $settingsCompany = $this->em->getRepository(Settings::class)->getCompanyList($company);
            $settingsGlobal += $settingsCompany;
        }

        return $settingsGlobal;
    }

    public function getKeyValueList()
    {
        $list = [];
        $settings = $this->getList();

        foreach ($settings as $setting) {
            $list[$setting->getKey()] = 'a'; //$setting->getValue();
        }

        return $list;
    }

    public function getKeyValueListByType()
    {
        $list = [];
        $settings = $this->getList();

        foreach ($settings as $setting) {
            $list[$setting->getType()][$setting->getKey()] = 'a'; //$setting->getValue();
        }

        return $list;
    }

}
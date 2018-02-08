<?php

namespace App\Repository;

use App\Entity\Company;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class SettingsRepository extends EntityRepository
{

    public function getGlobalList()
    {
        return $this->findBy(['company' => null]);
    }

    public function getCompanyList(Company $company)
    {
        return $this->findBy(['company' => $company]);
    }

}

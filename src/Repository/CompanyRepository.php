<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class CompanyRepository extends EntityRepository
{
    public function getList()
    {
        return $this->findAll();
    }
}

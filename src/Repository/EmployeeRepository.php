<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class EmployeeRepository extends EntityRepository
{
    public function getList()
    {
        return $this->findAll();
    }
}

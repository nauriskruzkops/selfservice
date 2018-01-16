<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class EmployeeRepository extends EntityRepository
{
    private function getMyAvailable(): QueryBuilder
    {
        $qb = $this->createQueryBuilder('e');
        $qb->where($qb->expr()->isNull('e.deletedAt'));

        return $qb;
    }

    public function getList()
    {
        return $this->findAll();
    }

    public function getSelectList()
    {
        $qb = $this->getMyAvailable();
        $qb->orderBy('e.name', 'ASC');

        return $qb;
    }

}

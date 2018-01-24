<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class CompanyRepository extends EntityRepository
{
    private function getMyAvailable(): QueryBuilder
    {
        $qb = $this->createQueryBuilder('c');
        $qb->where($qb->expr()->isNull('c.deletedAt'));

        return $qb;
    }

    public function getList()
    {
        return $this->findAll();
    }

    public function getSelectList()
    {
        $qb = $this->getMyAvailable();
        $qb->orderBy('c.title', 'ASC');

        return $qb;
    }
}

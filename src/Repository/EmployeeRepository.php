<?php

namespace App\Repository;

use App\Entity\Company;
use App\Entity\CompanyEmployee;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;

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
        $qb = $this->getMyAvailable();
        return $qb;
    }

    public function getSelectList()
    {
        $qb = $this->getMyAvailable();
        $qb->orderBy('e.name', 'ASC');

        return $qb;
    }

    public function getPaginateList(Company $company, $page = 1, $limit = 5)
    {
        $qb = $this->getList();
        $qb->select([
            'e',
            'cr.startDate',
            'cr.endDate',
            'cr.department',
            'cr.position',
            ]);
        $qb->join('e.companyRelation', 'cr');
        $qb->where($qb->expr()->eq('cr.company', $company->getId()));



        $paginator = new Paginator($qb->getQuery());
        $paginator->getQuery()
            ->setFirstResult($limit * ($page - 1))
            ->setMaxResults($limit);

        return $paginator;
    }
}

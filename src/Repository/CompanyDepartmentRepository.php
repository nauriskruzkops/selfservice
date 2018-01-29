<?php

namespace App\Repository;

use App\Entity\Company;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;

class CompanyDepartmentRepository extends EntityRepository
{
    private function getMyAvailable(): QueryBuilder
    {
        $qb = $this->createQueryBuilder('cd');
        $qb->where($qb->expr()->isNull('cd.deletedAt'));
        $qb->orderBy('cd.title', 'ASC');

        return $qb;
    }

    public function getList()
    {
        $qb = $this->getMyAvailable();

        return $qb;
    }

    public function getListByDepartments($department = null)
    {
        $qb = $this->getMyAvailable();
        $result = $qb->getQuery()->getResult();

        return $result;
    }

    public function getSelectList()
    {
        $qb = $this->getMyAvailable();

        return $qb;
    }

    public function getPaginateList(Company $company, $page = 1, $limit = 20)
    {
        $qb = $this->getList();
        $qb->where($qb->expr()->eq('cd.company', $company->getId()));

        $paginator = new Paginator($qb->getQuery());
        $paginator->getQuery()
            ->setFirstResult($limit * ($page - 1))
            ->setMaxResults($limit);

        return $paginator;
    }
}

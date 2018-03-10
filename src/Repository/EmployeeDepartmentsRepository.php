<?php

namespace App\Repository;

use App\Entity\Company;
use App\Entity\CompanyDepartment;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;

class EmployeeDepartmentsRepository extends EntityRepository
{
    private function getMyAvailable(): QueryBuilder
    {
        $qb = $this->createQueryBuilder('ce');
        $qb->where($qb->expr()->isNull('ce.deletedAt'));

        return $qb;
    }

    public function getList()
    {
        $qb = $this->getMyAvailable();

        return $qb;
    }

    public function getListByDepartments(CompanyDepartment $department)
    {
        $qb = $this->getMyAvailable();
        $qb->where(
            $qb->expr()->eq(
                'ce.department', $department->getId()
            )
        );
        $result = $qb->getQuery()->getResult();

        return $result;
    }

    public function getPaginateList(Company $company, $page = 1, $limit = 20)
    {
        $qb = $this->getList();
        //$qb->where($qb->expr()->eq('ce.company', $company->getId()));

        $paginator = new Paginator($qb->getQuery());
        $paginator->getQuery()
            ->setFirstResult($limit * ($page - 1))
            ->setMaxResults($limit);

        return $paginator;
    }
}

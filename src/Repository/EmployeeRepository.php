<?php

namespace App\Repository;

use App\Entity\Company;
use App\Entity\Employee;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;

class EmployeeRepository extends EntityRepository
{
    private function getMyAvailable(): QueryBuilder
    {
        $qb = $this->createQueryBuilder('e');
        $qb->where($qb->expr()->isNull('e.deletedAt'));
        $qb->orderBy('e.name', 'ASC');

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

        return $qb;
    }

    /**
     * @param $email
     * @return Employee|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getByEmail($email)
    {
        $qb = $this->getMyAvailable();
        $qb->where($qb->expr()->eq('e.email', ':email'))
            ->setParameter('email', trim($email));

        return $qb->getQuery()->getOneOrNullResult();
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

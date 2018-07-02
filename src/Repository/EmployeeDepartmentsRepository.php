<?php

namespace App\Repository;

use App\Entity\Company;
use App\Entity\CompanyDepartment;
use App\Entity\Employee;
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

    public function serachByFilterForm(array $formData = null, $page = 1, $limit = 20)
    {
        $em = $this->getEntityManager();
        $qb = $this->getMyAvailable();

        $department = $formData['department'] ?? false;
        if($department && !empty($department)) {
            $qb->andWhere(
                $qb->expr()->eq('ce.department', ':department')
            )->setParameter('department', $department);
        }

        $search = $formData['search'] ?? false;
        if($search && !empty($search)) {
            $searchQb = $em->createQueryBuilder();
            $searchQb
                ->select('1')
                ->from(Employee::class, 'e')
                ->where(
                    $searchQb->expr()->eq('e.id', 'ce.employee')
                )
                ->andWhere(
                    $searchQb->expr()->orX(
                        $searchQb->expr()->like('e.name', ':name_search'),
                        $searchQb->expr()->like('e.surname', ':surname_search'),
                        $searchQb->expr()->like('e.email', ':email_search')
                    )
                );

            $qb->andWhere(
                $qb->expr()->exists($searchQb)
            )
                ->setParameter('name_search', $search)
                ->setParameter('surname_search', $search)
                ->setParameter('email_search', $search)
            ;
        }

        if ($page && $limit) {
            $paginator = new Paginator($qb->getQuery());
            $paginator->getQuery()->setFirstResult($limit * ($page - 1));
            $paginator->getQuery()->setMaxResults($limit);

            return $paginator;
        }

        return $qb->getQuery()->getResult();
    }
}

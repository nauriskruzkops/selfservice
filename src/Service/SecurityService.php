<?php

namespace App\Service;

use App\Entity\CompanyDepartment;
use App\Entity\Employee;
use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityService
{
    /** @var EntityManager  */
    private $em;

    /**
     * SettingsService constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @return \App\Entity\User
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function registerUser(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $email = $request->get('_useremail', null);

        if (!empty($email) && strlen($email) > 3 && strlen($email) < 100) {
            /** @var Employee $employee */
            if (($employee = $this->em->getRepository(Employee::class)->getByEmail($email))) {

                if (!$employee->getUser()) {

                    $user = new \App\Entity\User();
                    $encoded = $encoder->encodePassword($user, $email);
                    $user->setPassword($encoded);
                    $user->setEmployee($employee);
                    $user->setUsername(trim($email));
                    $user->setActive(true);
                    $user->setRoles($this->getUserRole($employee));

                    $this->em->persist($user);
                    $this->em->flush();

                    return $user;
                }

                return $employee->getUser();
            }
        }
    }

    /**
     * @param Employee $employee
     * @return array
     */
    private function getUserRole(Employee $employee)
    {
        $role = $employee->getUser()->getRoles();

        /** @var CompanyDepartment[] $departments */
        $departments = $this->em->getRepository(CompanyDepartment::class)->findAll();

        if ($departments) {
            foreach ($departments as $department) {
                if ($department->getManager() == $employee) {
                    array_push($role, User::ROLE_MANAGER);
                    break;
                }
            }
        }

        return $role;
    }
}
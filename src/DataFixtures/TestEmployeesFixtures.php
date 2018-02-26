<?php

namespace App\DataFixtures;

use App\Entity\Company;
use App\Entity\CompanyDepartment;
use App\Entity\CompanyEmployee;
use App\Entity\Employee;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class TestEmployeesFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $companies = $manager->getRepository(Company::class)->findBy([],['id' => 'DESC']);
        /** @var Company $company */
        $company = reset($companies);
        $departments = $company->getDepartments();
        $totalDepartments = $departments->count();

        for ($i = 1; $i <= 100; $i++) {

            $companyEmployee = new CompanyEmployee();
            {
                $employee = new Employee();
                $employee->setCreatedAt(new \DateTime());
                $employee->setName($this->getRandomName());
                $employee->setSurname($this->getRandomSurname());
                if (rand(0,2) === 0) {
                    $employee->setSecondName( rand(0,1) ? $this->getRandomSurname() : $this->getRandomName());
                }
                $employee->setGender( rand(0,1) ? Employee::FEMALE : Employee::MALE);
                $employee->setEmail($employee->getName() . '.' . $employee->getSurname() . '@crocolab.com');
                $employee->setPersonalId('980' . rand(100000, 100000));
                $companyEmployee->setEmployee($employee);
            }{
                $companyEmployee->setCompany($company);
                $companyEmployee->setStartDate(
                    (new \DateTime())->setDate('20'.rand(15,17),''.rand(1,12),''.rand(1,27))
                );
            }{
                $companyEmployee->setDepartment($departments->getIterator()[rand(0, $totalDepartments-1)]);
            }
            $manager->persist($companyEmployee);
            $manager->flush();
        }

        foreach ($departments as $department) {
            $employees = $department->getEmployees();
            if ($employees) {
                $department->setManager($employees->getIterator()[rand(1, $employees->count() - 1)]->getEmployee());
            }
        }

        /** @var User $admin - add superuser to system */
        $admin = $manager->getRepository(User::class)->findOneBy(['username' => 'admin']);
        $admin->setEmployee($employee);

        $manager->merge($admin);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            TestCompaniesFixtures::class,
        ];
    }

    private function getRandomName()
    {
        $names = [
            'Joseph',
            'Christopher',
            'John',
            'Ricky',
            'Milhouse',
            'Bryan L.',
            'Ryan',
            'Lisa',
            'Bart',
            'Marge',
            'Nancy',
            'Homer',
            'Ethan',
            'Moe',
            'Bart',
            'John',
            'Michael',
            'Maureen',
            'Mona',
            'Carol',
            'Sarah',
            'Maggie',
            'Greg',
            'Charles Montgomery',
            'Michelle',
            'Abe',
            'Samantha',
            'Robert K.',
            'Mary',
            'Krusty',
            'Tanya',
            'Ned',
            'Seymour',
        ];

        return ucfirst($names[mt_rand(0, sizeof($names) - 1)]);
    }

    private function getRandomSurname()
    {
        $surnames = [
            'Skinner',
            'Baker',
            'Walker',
            'Simpson',
            'Van Houten',
            'Thompson',
            'Young',
            'Szyslak',
            'Anderson',
            'Johnson',
            'Simpson',
            'Flanders',
            'Houten',
            'Clown',
            'Simpson',
            'Burns',
            'Patterson',
            'Tremblay',
            'Peltier',
            'Thompson',
            'Stevens',
            'Stevenson',
            'Cunningham',
            'Simpson',
            'Mercado',
            'Sellers',
            'Yeager',
        ];

        return $surnames[mt_rand(0, sizeof($surnames) - 1)];
    }

}
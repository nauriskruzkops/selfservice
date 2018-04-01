<?php

namespace App\DataFixtures;

use App\Entity\Company;
use App\Entity\CompanyDepartment;
use App\Entity\VacationType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class TestCompaniesFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $companyTitle = "Main Company inc.";
        if (($cc = $manager->getRepository(Company::class)->findBy(['title' => 'Main Company inc.']))) {
            $companyTitle = "Other Company ".(count($cc)+1)." inc.";
        }

        $company = new Company();
        $company->setTitle($companyTitle);

        $company->addDepartments((new CompanyDepartment())->setTitle('Head Office'));
        $company->addDepartments((new CompanyDepartment())->setTitle('Accounting'));
        $company->addDepartments((new CompanyDepartment())->setTitle('Advertising'));
        $company->addDepartments((new CompanyDepartment())->setTitle('Lawyers Department'));
        $company->addDepartments((new CompanyDepartment())->setTitle('Human Resources'));
        $company->addDepartments((new CompanyDepartment())->setTitle('Project Management'));
        $company->addDepartments((new CompanyDepartment())->setTitle('Project Development'));
        $company->addDepartments((new CompanyDepartment())->setTitle('IT development'));
        $company->addDepartments((new CompanyDepartment())->setTitle('IT support'));
        $company->addDepartments((new CompanyDepartment())->setTitle('Customer Service'));

        $vacationType = new VacationType();
        $vacationType->setTitle('Paid annual vacation');
        $vacationType->setDaysLeave(23);
        $vacationType->setPaidPercents(100);
        $company->addVacationType($vacationType);

        $vacationType = new VacationType();
        $vacationType->setTitle('Other paid leave days');
        $vacationType->setDaysLeave(5);
        $vacationType->setPaidPercents(100);
        $company->addVacationType($vacationType);

        $vacationType = new VacationType();
        $vacationType->setTitle('Other unpaid leave days');
        $vacationType->setDaysLeave(100);
        $vacationType->setPaidPercents(0);
        $company->addVacationType($vacationType);

        $manager->persist($company);
        $manager->flush();
        $manager->clear();
    }

    public function getDependencies()
    {
        return [
            AdminUserFixtures::class,
        ];
    }
}
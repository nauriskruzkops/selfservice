<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="employees_hierarchy")
 */
class EmployeesHierarchy {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Company
     * @ORM\OneToOne(targetEntity="App\Entity\Company")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     */
    private $company;

    /**
     * @var Employee
     * @ORM\OneToOne(targetEntity="App\Entity\Employee")
     * @ORM\JoinColumn(name="lead_employee_id", referencedColumnName="id")
     */
    private $lead;

    /**
     * @var Employee
     * @ORM\OneToOne(targetEntity="App\Entity\Employee")
     * @ORM\JoinColumn(name="employee_id", referencedColumnName="id")
     */
    private $employee;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return EmployeesHierarchy
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Company
     */
    public function getCompany(): Company
    {
        return $this->company;
    }

    /**
     * @param Company $company
     * @return EmployeesHierarchy
     */
    public function setCompany(Company $company): EmployeesHierarchy
    {
        $this->company = $company;
        return $this;
    }

    /**
     * @return Employee
     */
    public function getLead(): Employee
    {
        return $this->lead;
    }

    /**
     * @param Employee $lead
     * @return EmployeesHierarchy
     */
    public function setLead(Employee $lead): EmployeesHierarchy
    {
        $this->lead = $lead;
        return $this;
    }

    /**
     * @return Employee
     */
    public function getEmployee(): Employee
    {
        return $this->employee;
    }

    /**
     * @param Employee $employee
     * @return EmployeesHierarchy
     */
    public function setEmployee(Employee $employee): EmployeesHierarchy
    {
        $this->employee = $employee;
        return $this;
    }


}
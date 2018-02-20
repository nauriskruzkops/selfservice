<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CompanyDepartmentRepository")
 * @ORM\Table(name="company_departments")
 */
class CompanyDepartment {

    use Traits\Traceability;

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Company
     * @ORM\ManyToOne(targetEntity="App\Entity\Company")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     */
    private $company;


    /**
     * @var Employee
     * @ORM\ManyToOne(targetEntity="App\Entity\Employee")
     * @ORM\JoinColumn(name="manager_id", referencedColumnName="id")
     */
    private $manager;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $title;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getTitle();
    }

    /**
     * @return Company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param Company $company
     * @return CompanyDepartment
     */
    public function setCompany(Company $company)
    {
        $this->company = $company;
        
        return $this;
    }

    /**
     * @return Employee
     */
    public function getManager()
    {
        return $this->manager;
    }

    /**
     * @param Employee $manager
     * @return CompanyDepartment
     */
    public function setManager(Employee $manager)
    {
        $this->manager = $manager;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    public function getShortTitle()
    {
        $splitWords = explode(' ', $this->getTitle());
        if (count($splitWords) > 1) {
            return implode('',array_map(function ($v){
                return strtoupper($v[0]);
            }, $splitWords));
        }
        return strtoupper(substr(reset($splitWords), 0, 2));
    }

    /**
     * @param mixed $title
     * @return CompanyDepartment
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }
}
<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CompanyRepository")
 * @ORM\Table(name="company")
 */
class Company {

    use Traits\Traceability;

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Company
     * @ORM\OneToOne(targetEntity="App\Entity\Company")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    private $parent;

    /**
     * One Customer has One Cart.
     * @ORM\OneToMany(targetEntity="App\Entity\CompanyDepartment", mappedBy="company")
     */
    private $departments;

    /**
     * One Customer has One Cart.
     * @ORM\OneToMany(targetEntity="App\Entity\CompanyEmployee", mappedBy="company")
     */
    private $employees;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $registrationNo;

    /**
     * Company constructor.
     */
    public function __construct()
    {
        $this->employees = new ArrayCollection();
        $this->parent = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getTitle();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @return mixed
     */
    public function getDepartments()
    {
        return $this->departments;
    }

    /**
     * @param mixed $departments
     * @return Company
     */
    public function setDepartments($departments)
    {
        $this->departments = $departments;
        return $this;
    }

    /**
     * @param mixed $parent
     */
    public function setParent($parent): void
    {
        $this->parent = $parent;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getRegistrationNo()
    {
        return $this->registrationNo;
    }

    /**
     * @param mixed $registrationNo
     */
    public function setRegistrationNo($registrationNo): void
    {
        $this->registrationNo = $registrationNo;
    }

    /**
     * @return mixed
     */
    public function getEmployees()
    {
        return $this->employees;
    }

    /**
     * @param mixed $employees
     * @return Company
     */
    public function setEmployees($employees)
    {
        $this->employees = $employees;

        return $this;
    }


}
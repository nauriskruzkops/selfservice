<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EmployeeRepository")
 * @ORM\Table(name="employee")
 */
class Employee {

    use Traits\Traceability;

    const MALE = 1;
    const FEMALE = 0;

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $secondName;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $surname;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $personalId;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $gender;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $foreigner;

    /**
     * One Product has Many Features.
     * @ORM\OneToMany(targetEntity="Vacation", mappedBy="employee")
     */
    private $vacations;

    /**
     * One Product has Many Features.
     * @ORM\OneToMany(targetEntity="CompanyEmployee", mappedBy="employee", cascade={"persist", "remove"})
     */
    private $companyRelation;

    /**
     * @var User
     * @ORM\OneToOne(targetEntity="User", mappedBy="employee", orphanRemoval=true, fetch="EAGER")
     */
    private $user;

    public function __construct()
    {
        $this->foreigner = false;
        $this->companyRelation = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getFullName();
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Employee
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSecondName()
    {
        return $this->secondName;
    }

    /**
     * @param mixed $secondName
     * @return Employee
     */
    public function setSecondName($secondName)
    {
        $this->secondName = $secondName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param mixed $surname
     * @return Employee
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
        return $this;
    }

    public function getFullName()
    {
        return implode(' ', array_filter([
            $this->getName(),
            $this->getSecondName(),
            $this->getSurname()
        ]));
    }

    /**
     * @return mixed
     */
    public function getPersonalId()
    {
        return $this->personalId;
    }

    /**
     * @param mixed $personalId
     * @return Employee
     */
    public function setPersonalId($personalId)
    {
        $this->personalId = $personalId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     * @return Employee
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return Employee
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getForeigner()
    {
        return $this->foreigner;
    }

    /**
     * @param mixed $foreigner
     * @return Employee
     */
    public function setForeigner($foreigner)
    {
        $this->foreigner = $foreigner;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVacations()
    {
        return $this->vacations;
    }

    /**
     * @param mixed $vacations
     * @return Employee
     */
    public function setVacations($vacations)
    {
        $this->vacations = $vacations;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCompanyRelation()
    {
        return $this->companyRelation;
    }

    /**
     * @return CompanyEmployee
     */
    public function getLastRelation()
    {
        return $this->companyRelation->last();
    }

    /**
     * @param mixed $companyRelation
     * @return Employee
     */
    public function setCompanyRelation($companyRelation)
    {
        $this->companyRelation = $companyRelation;
        return $this;
    }

    /**
     * @param mixed $companyRelation
     * @return Employee
     */
    public function addCompanyRelation(CompanyEmployee $companyRelation)
    {
        if (!$this->companyRelation->contains($companyRelation)) {
            $companyRelation->setEmployee($this);
            $this->companyRelation->add($companyRelation);
        }
        return $this;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return $this
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

}
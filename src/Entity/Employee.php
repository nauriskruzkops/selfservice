<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Event\LifecycleEventArgs;
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
     * @var Company
     * @ORM\ManyToOne(targetEntity="App\Entity\Company", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     */
    private $company;

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
     * @ORM\OneToMany(targetEntity="EmployeeDepartments", mappedBy="employee", cascade={"persist", "remove"})
     */
    private $departments;

    /**
     * @ORM\OneToMany(targetEntity="CompanyDepartment", mappedBy="manager")
     */
    protected $manageDepartments;

    /**
     * @var EmployeeDepartments[]
     */
    private $allRelatedDepartments;

    /**
     * @var User
     * @ORM\OneToOne(targetEntity="User", mappedBy="employee", orphanRemoval=true, fetch="EAGER")
     */
    private $user;

    public function __construct()
    {
        $this->foreigner = false;
        $this->departments = new ArrayCollection();
        $this->vacations = new ArrayCollection();
    }

    /**
     * ORM\PostLoad()
     */
    public function postLoadFunction(LifecycleEventArgs $eventArgs)
    {
        $em = $eventArgs->getEntityManager();
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
     * @return Employee
     */
    public function setCompany(Company $company)
    {
        $this->company = $company;

        return $this;
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


    public function getShortTitle()
    {
        $splitWords = explode(' ', $this->getFullName());
        if (count($splitWords) === 1) {
            $short =
                strtoupper(mb_substr($splitWords[0], 0, 3));
        } elseif (count($splitWords) <= 2) {
            $short =
                strtoupper(mb_substr($splitWords[0], 0, 1)).
                strtoupper(mb_substr($splitWords[1], 0, 2));
        } else {
            $short = "";
            foreach ($splitWords as $w) {
                $short .= strtoupper(mb_substr($w, 0, 1));
            }
        }

        return trim($short);
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
     * @return ArrayCollection
     */
    public function getDepartments()
    {
        return $this->departments;
    }

    /**
     * @return EmployeeDepartments
     */
    public function getDepartment()
    {
        return $this->departments->last();
    }

    /**
     * Get all departments where employee take action
     *
     * @return array
     */
    public function getAllDepartment()
    {
        $collector = [
            'manager' => new ArrayCollection(),
            'user' =>  new ArrayCollection(),
        ];

        foreach ($this->getDepartments() as $employeeDepartment) {
            /** @var ArrayCollection */
            if (!$collector['user']->contains($employeeDepartment->getDepartment())) {
                $collector['user']->add($employeeDepartment->getDepartment());
            }
        }

        if (($manager = $this->getManager())) {
            if (!$collector['user']->contains($manager->getDepartment()->getDepartment())) {
                $collector['user']->add($manager->getDepartment()->getDepartment());
            }
        }

        foreach ($this->manageDepartments as $manageDepartment) {
            if (!$collector['manager']->contains($manageDepartment)) {
                $collector['manager']->add($manageDepartment);
            }
        }

        $collector['all'] = $collector['user'];
        foreach ($collector['manager'] as $add) {
            if (!$collector['all']->contains($add)) {
                $collector['all']->add($add);
            }
        }

        return $collector;
    }

    /** @return Employee */
    public function getManager()
    {
        $manager = null;

        /** @var EmployeeDepartments[] $departments */
        $departments = $this->departments->filter(function (EmployeeDepartments $d){
            return ($d->getManager() !== $this);
        });

        if ($departments) {
            if (!($manager = $departments->last()->getManager())) {
                $manager = $departments->last()->getDepartment()->getManager();
            }
        }

        return $manager !== $this ? $manager : null;
    }

    /**
     * @param mixed $departments
     * @return Employee
     */
    public function setDepartments($departments)
    {
        $this->departments = $departments;
        return $this;
    }

    /**
     * @param mixed $companyRelation
     * @return Employee
     */
    public function addDepartment(EmployeeDepartments $companyRelation)
    {
        if (!$this->departments->contains($companyRelation)) {
            $companyRelation->setEmployee($this);
            $this->departments->add($companyRelation);
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
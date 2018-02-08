<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="vacation_period")
 */
class VacationPeriod {

    use Traits\Traceability;

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Employee", inversedBy="vacations")
     * @ORM\JoinColumn(name="employee_id", referencedColumnName="id")
     */
    private $employee;

    /**
     * @ORM\OneToMany(targetEntity="Vacation", mappedBy="vacationPeriod")
     */
    private $vacations;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $startDate;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $endDate;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $annualDays;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $additionalDays;

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
    public function getEmployee()
    {
        return $this->employee;
    }

    /**
     * @param mixed $employee
     * @return VacationPeriod
     */
    public function setEmployee($employee)
    {
        $this->employee = $employee;

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
     * @return VacationPeriod
     */
    public function setVacations($vacations)
    {
        $this->vacations = $vacations;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param mixed $startDate
     * @return VacationPeriod
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param mixed $endDate
     * @return VacationPeriod
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAnnualDays()
    {
        return $this->annualDays;
    }

    /**
     * @param mixed $annualDays
     * @return VacationPeriod
     */
    public function setAnnualDays($annualDays)
    {
        $this->annualDays = $annualDays;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAdditionalDays()
    {
        return $this->additionalDays;
    }

    /**
     * @param mixed $additionalDays
     * @return VacationPeriod
     */
    public function setAdditionalDays($additionalDays)
    {
        $this->additionalDays = $additionalDays;

        return $this;
    }

}
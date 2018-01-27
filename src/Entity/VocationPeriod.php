<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="vocation_period")
 */
class VocationPeriod {

    use Traits\Traceability;

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Employee", inversedBy="vocations")
     * @ORM\JoinColumn(name="employee_id", referencedColumnName="id")
     */
    private $employee;

    /**
     * @ORM\OneToMany(targetEntity="Vocation", mappedBy="vocationPeriod")
     */
    private $vocations;

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
     * @return VocationPeriod
     */
    public function setEmployee($employee)
    {
        $this->employee = $employee;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getVocations()
    {
        return $this->vocations;
    }

    /**
     * @param mixed $vocations
     * @return VocationPeriod
     */
    public function setVocations($vocations)
    {
        $this->vocations = $vocations;

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
     * @return VocationPeriod
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
     * @return VocationPeriod
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
     * @return VocationPeriod
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
     * @return VocationPeriod
     */
    public function setAdditionalDays($additionalDays)
    {
        $this->additionalDays = $additionalDays;

        return $this;
    }

}
<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="vacation")
 */
class Vacation {

    use Traits\Traceability;

    const TYPE_ANNUAL = 'annual';
    const TYPE_UNPAID = 'unpaid';
    const TYPE_PARENTAL = 'parental';
    const TYPE_OTHER = 'other';

    const TYPES = [
        self::TYPE_ANNUAL => 'Annual',
        self::TYPE_UNPAID => 'Unpaid',
        self::TYPE_PARENTAL => 'Parental',
        self::TYPE_OTHER => 'Other',
    ];

    const STATUS_DRAFT = 'draft';
    const STATUS_PLANNED = 'planned';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';

    const STATUSES = [
        self::STATUS_DRAFT => 'Draft',
        self::STATUS_PLANNED => 'Planned',
        self::STATUS_APPROVED => 'Approved',
        self::STATUS_REJECTED => 'Rejected',
    ];

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Employee", inversedBy="vacations")
     * @ORM\JoinColumn(name="employee_id", referencedColumnName="id")
     */
    private $employee;

    /**
     * @ORM\ManyToOne(targetEntity="VacationPeriod", inversedBy="vacations")
     * @ORM\JoinColumn(name="vacation_period_id", referencedColumnName="id")
     */
    private $vacationPeriod;

    /**
     * @ORM\Column(type="date", nullable=false)
     */
    private $startDate;

    /**
     * @ORM\Column(type="date", nullable=false)
     */
    private $endDate;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $status;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Vacation
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     * @return Vacation
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
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
     * @return Vacation
     */
    public function setEmployee($employee)
    {
        $this->employee = $employee;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param mixed $startDate
     * @return Vacation
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param mixed $endDate
     * @return Vacation
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * @return bool|\DateInterval
     */
    public function getInterval()
    {
        return $this->getStartDate()->diff($this->getEndDate());
    }

    /**
     * @return integer
     */
    public function getDays()
    {
        $dateInterval = $this->getStartDate()->diff($this->getEndDate());

        return $dateInterval->days;
    }

    /**
     * @return mixed
     */
    public function getVacationPeriod()
    {
        return $this->vacationPeriod;
    }

    /**
     * @param mixed $vacationPeriod
     * @return Vacation
     */
    public function setVacationPeriod($vacationPeriod)
    {
        $this->vacationPeriod = $vacationPeriod;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     * @return Vacation
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }
}
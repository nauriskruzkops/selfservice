<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="vacations_types")
 */
class VacationType {

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
     * @ORM\JoinColumn(name="company_id", referencedColumnName="id", nullable=true)
     */
    private $company;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    private $daysLeave;


    /**
     * @ORM\Column(type="integer", nullable=false, options={"default" : 100})
     */
    private $paidPercents;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return VacationType
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Company
     */
    public function getCompany():? Company
    {
        return $this->company;
    }

    /**
     * @param Company $company
     * @return VacationType
     */
    public function setCompany(Company $company): VacationType
    {
        $this->company = $company;

        return $this;
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
     * @return VacationType
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDaysLeave()
    {
        return $this->daysLeave;
    }

    /**
     * @param mixed $daysLeave
     * @return VacationType
     */
    public function setDaysLeave($daysLeave)
    {
        $this->daysLeave = $daysLeave;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPaidPercents()
    {
        return $this->paidPercents;
    }

    /**
     * @param mixed $paidPercents
     * @return VacationType
     */
    public function setPaidPercents($paidPercents)
    {
        $this->paidPercents = $paidPercents;

        return $this;
    }

}
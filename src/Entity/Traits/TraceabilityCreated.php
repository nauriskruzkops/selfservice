<?php

namespace App\Entity\Traits;

trait TraceabilityCreated {

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    public $createdAt;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    public $createBy;

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     * @return $this
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreateBy()
    {
        return $this->createBy;
    }

    /**
     * @param mixed $createBy
     * @return $this
     */
    public function setCreateBy($createBy)
    {
        $this->createBy = $createBy;

        return $this;
    }

}
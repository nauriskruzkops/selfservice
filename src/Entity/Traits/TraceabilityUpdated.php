<?php

namespace App\Entity\Traits;

trait TraceabilityUpdated {

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    public $updatedAt;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    public $updateBy;

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     * @return TraceabilityUpdated
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUpdateBy()
    {
        return $this->updateBy;
    }

    /**
     * @param mixed $updateBy
     * @return TraceabilityUpdated
     */
    public function setUpdateBy($updateBy)
    {
        $this->updateBy = $updateBy;

        return $this;
    }


}
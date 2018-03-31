<?php

namespace App\Entity\Traits;

/**
 * Trait TraceabilityDeleted
 * @package App\Entity\Traits
 */
trait TraceabilityDeleted {
    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    public $deletedAt;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    public $deletedBy;

    /**
     * @return \DateTime
     */
    public function getDeletedAt(): \DateTime
    {
        return $this->deletedAt;
    }

    /**
     * @param \DateTime $deletedAt
     * @return $this
     */
    public function setDeletedAt(\DateTime $deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDeletedBy()
    {
        return $this->deletedBy;
    }

    /**
     * @param mixed $deletedBy
     * @return $this
     */
    public function setDeletedBy($deletedBy)
    {
        $this->deletedBy = $deletedBy;

        return $this;
    }
}
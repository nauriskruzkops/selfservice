<?php

namespace App\Entity\Traits;

use App\Entity\User;

/**
 * Trait TraceabilityUpdated
 *
 * @package App\Entity\Traits
 * @ORM\HasLifecycleCallbacks
 * @ORM\EntityListeners({"TraceabilityListener"})
 */
trait TraceabilityUpdated {
    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    public $updatedAt;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="App\Entity\User", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="updated_by", referencedColumnName="id")
     */
    public $updatedBy;

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
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    /**
     * @param mixed $updatedBy
     * @return TraceabilityUpdated
     */
    public function setUpdatedBy($updatedBy)
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }


}
<?php

namespace App\Entity\Traits;

trait Serializable {

    /**
     * String representation of object
     */
    public function serialize()
    {
        // empty
    }

    /**
     * Constructs the object
     */
    public function unserialize($serialized)
    {
        // empty
    }
}
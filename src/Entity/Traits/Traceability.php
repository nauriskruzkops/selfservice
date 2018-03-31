<?php

namespace App\Entity\Traits;

trait Traceability {
    use TraceabilityCreated;
    use TraceabilityUpdated;
    use TraceabilityDeleted;
}
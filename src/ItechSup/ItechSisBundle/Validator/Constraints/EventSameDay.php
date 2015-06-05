<?php

// src/ItechSup/ItechSisBundle/Validator/Constraints/EventSameDay.php

namespace ItechSup\ItechSisBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class EventSameDay extends Constraint
{
    public $message = "Un event ne peut être que sur une seule journée ";

    public function validatedBy()
    {
        return get_class($this).'Validator';
    }
}
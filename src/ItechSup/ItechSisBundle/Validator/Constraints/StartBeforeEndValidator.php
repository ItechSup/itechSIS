<?php

// src/ItechSup/ItechSisBundle/Validator/Constraints/startBeforeEndValidator.php
namespace ItechSup\ItechSisBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class StartBeforeEndValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        $start=  ->getStartTime();
        $end= ->getEndtime();

        if ($end < $start) {
            $this->context->addViolation($constraint->$message, array());
        }
    }
}
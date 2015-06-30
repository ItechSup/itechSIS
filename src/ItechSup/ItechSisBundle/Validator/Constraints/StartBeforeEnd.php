<?php
// src/ItechSup/ItechSisBundle/Validator/Constraints/startBeforeEnd.php
namespace ItechSup\ItechSisBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;


/**
 * @Annotation
 */
class StartBeforeEnd extends Constraint {
    public $message = 'La date de début doit être antérieur à la date de fin';
}
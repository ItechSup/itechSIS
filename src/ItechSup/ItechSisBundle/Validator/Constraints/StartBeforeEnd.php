<?php

// src/ItechSup\ItechSis\Bundle/Validator/Constraints/StartBeforeEnd.php
namespace ItechSup\ItechSisBundle\Validator\Constraints;

use ItechSup\ItechSisBundle\Validator\Constraints;
use Symfony\Component\Validator\Constraint;
use ItechSup\ItechSisBundle\Validator\Constraints\StartBeforeEndValidator;

/**
* @Annotation
*/
class StartBeforeEnd extends Constraint
{
public $message = 'La chaîne "%string%" contient un caractère non autorisé : elle ne peut contenir que des lettres et des chiffres.';
}
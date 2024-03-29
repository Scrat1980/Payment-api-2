<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
class TaxNumberFormat extends Constraint
{
    public string $message = 'Tax format \'%value%\' is invalid';
}
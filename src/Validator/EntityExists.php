<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

class EntityExists extends Constraint
{
    public string $message = 'Entity \'%value%\' is not available in our storage';
    public string $mode = '';
    public $property;
    public $entity;
}
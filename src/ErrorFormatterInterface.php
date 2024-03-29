<?php

namespace App;

use Symfony\Component\Validator\ConstraintViolationListInterface;
use Exception;
Interface ErrorFormatterInterface
{
    /**
     * @param ConstraintViolationListInterface|Exception $errors
     * @return array
     */
    public function format(ConstraintViolationListInterface|Exception $errors): array;
}
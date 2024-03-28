<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
class CouponFormat extends Constraint
{
    public string $message = 'Coupon \'%value%\' doesn\'t present in our storage';
}
<?php

namespace App\Service\Coupon;

class PercentCalculator implements ICalculator
{
    public function apply(int $price, int $value): float
    {
        return ($price * (1 - $value/100));
    }
}
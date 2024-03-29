<?php

namespace App\Service\Coupon;

class NeutralCalculator implements ICalculator
{
    public function apply(int $price, int $value): float
    {
        return (float) $price;
    }
}
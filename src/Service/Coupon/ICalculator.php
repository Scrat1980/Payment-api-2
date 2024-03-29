<?php

namespace App\Service\Coupon;

interface ICalculator
{
    public function apply(int $price, int $value): float;
}
<?php

namespace App\Service\Coupon;

use Exception;

class FixCalculator implements ICalculator
{
    public function apply(int $price, int $value): float
    {
        if ($price < $value) {
            throw new Exception('Can\'t apply fixed discount: it is more than the price');
        }

        return ($price - $value);
    }
}
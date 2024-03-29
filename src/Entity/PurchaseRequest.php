<?php

namespace App\Entity;

class PurchaseRequest
{
    public $product;
    public $taxNumber;
    public $couponCode;
    public $paymentProcessor;
}
<?php

namespace App\Service\PaymentProcessor;

interface IPaymentProcessor
{
    /**
     * @param int $price
     * @throws PaymentProcessorException
     */
    public function behave(array $price): void;
}
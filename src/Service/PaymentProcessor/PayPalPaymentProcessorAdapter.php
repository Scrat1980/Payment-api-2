<?php

namespace App\Service\PaymentProcessor;

use Systemeio\TestForCandidates\PaymentProcessor\PaypalPaymentProcessor;

class PayPalPaymentProcessorAdapter implements IPaymentProcessor
{
    private PaypalPaymentProcessor $processor;
    public function __construct(PaypalPaymentProcessor $processor)
    {
        $this->processor = $processor;
    }
    public function behave(array $price): void
    {
        try {
            $this->processor->pay((int) ($price[0] * 100 + $price[1]));
        } catch (\Exception $e)
        {
            throw new PaymentProcessorException(
                'Payment processor exception',
                0,
                $e
            );
        }
    }
}
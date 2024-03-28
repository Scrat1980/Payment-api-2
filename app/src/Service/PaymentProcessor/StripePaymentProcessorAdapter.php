<?php

namespace App\Service\PaymentProcessor;

use JMS\Serializer\Exception\Exception;
use Systemeio\TestForCandidates\PaymentProcessor\StripePaymentProcessor;

class StripePaymentProcessorAdapter implements IPaymentProcessor
{
    private StripePaymentProcessor $processor;

    public function __construct(StripePaymentProcessor $processor)
    {
        $this->processor = $processor;
    }
    public function behave(array $price): void
    {
        $isOk = $this->processor->processPayment($price[0] + $price[1]/100);

        if (! $isOk) {
            Throw new PaymentProcessorException(
                'Payment processor exception',
                0
            );
        }
    }
}
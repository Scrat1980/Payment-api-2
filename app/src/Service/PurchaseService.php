<?php

declare(strict_types=1);

namespace App\Service;

use App\Service\PaymentProcessor\PaymentProcessorException;
use App\Service\PaymentProcessor\PayPalPaymentProcessorAdapter;
use App\Service\PaymentProcessor\StripePaymentProcessorAdapter;
use Systemeio\TestForCandidates\PaymentProcessor\PaypalPaymentProcessor;
use Systemeio\TestForCandidates\PaymentProcessor\StripePaymentProcessor;

class PurchaseService
{
    private CalculatePriceService $service;

    public function __construct(
        CalculatePriceService $service
    )
    {
        $this->service = $service;
    }

    /**
     * @param $request
     * @return void
     * @throws PaymentProcessorException
     */
    public function purchase(
        int $productId,
        string $couponCode,
        string $taxNumber,
        string $paymentProcessor
    ): void
    {
        $price = $this->service->do($productId, $couponCode, $taxNumber);

        $paymentProcessor = match($paymentProcessor)
        {
            'paypal' => new PayPalPaymentProcessorAdapter(
                new PaypalPaymentProcessor()
            ),
            'stripe' => new StripePaymentProcessorAdapter(
                new StripePaymentProcessor()
            ),
        };

        $paymentProcessor->behave(explode('.', $price));
    }
}
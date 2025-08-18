<?php

namespace App\Services\Payments;

class StripePaymentService implements PaymentGatewayInterface
{
    public function charge(float $amount): string
    {
        return "Charged $amount via Stripe";
    }
}
<?php

namespace App\Services\Payments;

class PaypalPaymentService implements PaymentGatewayInterface
{
    public function charge(float $amount): string
    {
        return "Charged $amount via PayPal";
    }
}
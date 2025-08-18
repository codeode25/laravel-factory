<?php

namespace App\Services\Payments;

class CashOnDeliveryService implements PaymentGatewayInterface
{
    public function charge(float $amount): string
    {
        return "Payment of $amount will be collected on delivery";
    }
}
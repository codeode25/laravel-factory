<?php

namespace App\Services\Payments;

use RuntimeException;
use App\Services\Payments\PaypalPaymentService;
use App\Services\Payments\StripePaymentService;
use App\Services\Payments\CashOnDeliveryService;

class PaymentGatewayFactory
{
    public function make(string $gateway)
    {
        return match ($gateway) {
            'stripe' => new StripePaymentService(),
            'paypal' => new PaypalPaymentService(),
            'cod' => new CashOnDeliveryService(),
            default => throw new RuntimeException("Invalid payment gateway"),
        };
    }
}
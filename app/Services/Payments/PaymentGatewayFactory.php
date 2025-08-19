<?php

namespace App\Services\Payments;

use RuntimeException;
use Illuminate\Contracts\Container\Container;
use App\Services\Payments\PaypalPaymentService;
use App\Services\Payments\StripePaymentService;
use App\Services\Payments\CashOnDeliveryService;

class PaymentGatewayFactory
{
    public function __construct(private readonly Container $container) {}

    public function make(string $gateway)
    {
        return match ($gateway) {
            'stripe' => $this->container->make('stripe.adapter'),
            'paypal' => $this->container->make('paypal.adapter'),
            'cod' => $this->container->make('cod.adapter'),
            default => throw new RuntimeException("Invalid payment gateway"),
        };
    }
}
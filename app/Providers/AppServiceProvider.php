<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Payments\PaypalPaymentService;
use App\Services\Payments\StripePaymentService;
use App\Services\Payments\CashOnDeliveryService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind('stripe.adapter', function ($app) {
            return new StripePaymentService();
        });

        $this->app->bind('paypal.adapter', function ($app) {
            return new PaypalPaymentService();
        });

        $this->app->bind('cod.adapter', function ($app) {
            return new CashOnDeliveryService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

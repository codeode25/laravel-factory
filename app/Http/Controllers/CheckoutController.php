<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Payments\PaypalPaymentService;
use App\Services\Payments\StripePaymentService;
use App\Services\Payments\CashOnDeliveryService;
use App\Services\Payments\PaymentGatewayFactory;

class CheckoutController extends Controller
{
    public function pay(Request $request, PaymentGatewayFactory $factory)
    {
        $validated = $request->validate(
            [
                'gateway' => ['required', 'string', 'in:stripe,paypal,cod'],
                'amount' => 'numeric',
            ]
        );

        $gateway = $validated['gateway'];

        $service = $factory->make($gateway);
        $result = $service->charge($validated['amount']);

        return response()->json(['message' => $result, 'status' => 'success']);
    }
}

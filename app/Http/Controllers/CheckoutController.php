<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Payments\PaypalPaymentService;
use App\Services\Payments\StripePaymentService;
use App\Services\Payments\CashOnDeliveryService;

class CheckoutController extends Controller
{
    public function pay(Request $request)
    {
        $validated = $request->validate(
            [
                'gateway' => ['required', 'string', 'in:stripe,paypal,cod'],
                'amount' => 'numeric',
            ]
        );

        $gateway = $validated['gateway'];

        if ($gateway === 'stripe') {
            $service = new StripePaymentService();
        } elseif ($gateway === 'paypal') {
            $service = new PaypalPaymentService();
        } elseif ($gateway === 'cod') {
            $service = new CashOnDeliveryService();
        } else {
            throw new \InvalidArgumentException("Invalid payment gateway.");
        }

        $result = $service->charge($validated['amount']);

        return response()->json(['message' => $result, 'status' => 'success']);
    }
}

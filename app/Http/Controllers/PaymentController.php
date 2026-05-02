<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\PaymentInterface;

class PaymentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentInterface $paymentService)
    {
        $this->paymentService = $paymentService;
    }   

    public function checkout(Request $request)
    {
        $session = $this->paymentService->createPaymentIntent(10); // $10

        return redirect($session->url);
    }

    public function success()
    {
        return "Payment Successful 🎉";
    }

    public function cancel()
    {
        return "Payment Cancelled ❌";
    }
}
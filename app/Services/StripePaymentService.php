<?php

namespace App\Services;

use App\Interfaces\PaymentInterface;
use Illuminate\Support\Facades\Log;
use Stripe\{Price,Product,Stripe};
use Stripe\Checkout\Session;


class StripePaymentService implements PaymentInterface
{
    protected $secret_key;

    public function __construct()
    {
        $this->secret_key = config('services.stripe.secret');

        // Correct Log import
        Log::info("Stripe Service Constructor Called");

        Stripe::setApiKey($this->secret_key);
    }


    public function createProduct($name)
    {
        try {
            return Product::create([
                'name' => $name,
            ]);
        } catch (\Exception $e) {
            Log::error('Stripe Product Error: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Create Price in Stripe
     */
    public function createPrice($amount, $interval, $productId)
    {
        try {
            return Price::create([
                'unit_amount' => $amount * 100, // convert to paisa/cents
                'currency' => 'inr',
                'recurring' => [
                    'interval' => $interval, // month/year
                ],
                'product' => $productId,
            ]);
        } catch (\Exception $e) {
            Log::error('Stripe Price Error: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * One-time payment (Checkout Session)
     */
    public function createPaymentIntent($amount)
    {
        try {
            return Session::create([
                'payment_method_types' => ['card'],
                'mode' => 'payment',
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'inr',
                        'product_data' => [
                            'name' => 'Test Product',
                        ],
                        'unit_amount' => $amount * 100,
                    ],
                    'quantity' => 1,
                ]],
                'success_url' => route('success'),
                'cancel_url' => route('cancel'),
            ]);
        } catch (\Exception $e) {
            Log::error('Stripe Payment Error: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Subscription Checkout Session
     */
    public function createSubscription($priceId)
    {
        try {
            return Session::create([
                'mode' => 'subscription',
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price' => $priceId,
                    'quantity' => 1,
                ]],
                'success_url' => route('success'),
                'cancel_url' => route('cancel'),
            ]);
        } catch (\Exception $e) {
            Log::error('Stripe Subscription Error: ' . $e->getMessage());
            throw $e;
        }
    }
}
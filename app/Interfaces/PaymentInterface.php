<?php

namespace App\Interfaces;

interface PaymentInterface
{
    public function createProduct($name);
    public function createPrice($amount, $interval, $productId);
    public function createPaymentIntent($amount);
    public function createSubscription($priceId);
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['user_id', 'subscription_id', 'stripe_payment_intent_id','stripe_invoice_id', 'amount', 'currency' ,'status'];
}

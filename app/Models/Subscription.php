<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = ['user_id', 'plan_id', 'stripe_subscription_id', 'stripe_customer_id','status','current_period_start','current_period_end','ends_at'];
}

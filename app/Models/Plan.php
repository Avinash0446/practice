<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = ['name', 'description', 'price', 'currency', 'interval', 'stripe_product_id', 'stripe_price_id', 'is_active'];
}

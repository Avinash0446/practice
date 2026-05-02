<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;

class PlanController extends Controller
{
    public function create()
    {
        return view('plans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:1',
            'interval' => 'required|in:month,year',
            'description' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {
            // 1. Create plan locally
            $plan = Plan::create([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'interval' => $request->interval,
                'is_active' => $request->is_active ?? 1,
            ]);

            // 2. Connect to Stripe
            Stripe::setApiKey(config('services.stripe.secret'));

            // 3. Create product
            $product = \Stripe\Product::create([
                'name' => $plan->name,
            ]);

            // 4. Create price
            $price = \Stripe\Price::create([
                'unit_amount' => $plan->price * 100,
                'currency' => 'inr',
                'recurring' => [
                    'interval' => $plan->interval,
                ],
                'product' => $product->id,
            ]);

            // 5. Update plan with Stripe IDs
            $plan->update([
                'stripe_product_id' => $product->id,
                'stripe_price_id' => $price->id,
            ]);

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('plans.create')
            ->with('success', 'Plan created successfully!');
    }
}
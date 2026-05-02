<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Plan;
use App\Interfaces\PaymentInterface;
use Throwable;

class PlanController extends Controller
{
    protected PaymentInterface $payment;

    public function __construct(PaymentInterface $payment)
    {
        $this->payment = $payment;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:1',
            'interval' => 'required|in:month,year',
            'description' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {
            // 1. Create plan locally
            $plan = Plan::create([
                'name' => $validated['name'],
                'description' => $validated['description'] ?? null,
                'price' => $validated['price'],
                'interval' => $validated['interval'],
                'is_active' => $request->is_active ?? 1,
            ]);

            // 2. Stripe calls via service
            $product = $this->payment->createProduct($plan->name);

            $price = $this->payment->createPrice(
                $plan->price,
                $plan->interval,
                $product->id
            );

            // 3. Update Stripe IDs
            $plan->update([
                'stripe_product_id' => $product->id,
                'stripe_price_id' => $price->id,
            ]);

            DB::commit();

            return redirect()
                ->route('plans.create')
                ->with('success', 'Plan created successfully!');

        } catch (Throwable $e) {
            DB::rollBack();

            report($e); // better than exposing raw error

            return back()
                ->withInput()
                ->with('error', 'Something went wrong while creating the plan.');
        }
    }
}
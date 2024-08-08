<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscriptionRequest;
use App\Models\Product;
use App\Models\Subscription;


class SubscriptionController extends Controller
{
    public function subscription(SubscriptionRequest $request)
    {
        $request->validated();

        $product = Product::find($request->input('product_id'));

        $subscription = Subscription::create(
            [
                'user_id' => auth('sanctum')->user()->id,
                'product_id' => $request->input('product_id'),
                'payment_status' => 'pending',
                'receipt_token' => $request->input('receipt_token'),
                'expires_at' => now()->addDays($product->subscription_days),
            ]
        );

        return response()->json($subscription);
    }
}

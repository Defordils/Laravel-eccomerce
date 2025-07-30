<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = CartItem::where('user_id', Auth::id())
            ->with('product')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        $total = $cartItems->sum(function ($item) {
            return $item->getSubtotal();
        });

        return view('checkout.index', compact('cartItems', 'total'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|array',
            'shipping_address.name' => 'required|string',
            'shipping_address.address' => 'required|string',
            'shipping_address.city' => 'required|string',
            'shipping_address.postal_code' => 'required|string',
            'shipping_address.country' => 'required|string',
            'payment_method' => 'required|string'
        ]);

        $cartItems = CartItem::where('user_id', Auth::id())
            ->with('product')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        $total = $cartItems->sum(function ($item) {
            return $item->getSubtotal();
        });

        DB::beginTransaction();

        try {
            // Create order
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => Order::generateOrderNumber(),
                'status' => Order::STATUS_PENDING,
                'total_amount' => $total,
                'shipping_address' => $request->shipping_address,
                'billing_address' => $request->billing_address ?? $request->shipping_address,
                'payment_status' => Order::PAYMENT_PENDING,
                'payment_method' => $request->payment_method
            ]);

            // Create order items
            foreach ($cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->product->getCurrentPrice()
                ]);
            }

            // Process payment with Stripe
            if ($request->payment_method === 'stripe') {
                Stripe::setApiKey(config('services.stripe.secret'));

                $paymentIntent = PaymentIntent::create([
                    'amount' => $total * 100, // Convert to cents
                    'currency' => 'usd',
                    'metadata' => [
                        'order_id' => $order->id
                    ]
                ]);

                $order->update([
                    'stripe_payment_intent_id' => $paymentIntent->id
                ]);
            }

            // Clear cart
            CartItem::where('user_id', Auth::id())->delete();

            DB::commit();

            return redirect()->route('orders.show', $order)
                ->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}

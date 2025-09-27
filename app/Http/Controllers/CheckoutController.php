<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CheckoutController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $cartItems = $user->cartItems()->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('home')->with('info', 'Your cart is empty. Please add products before checking out.');
        }

        $totalPrice = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        return view('checkout.index', compact('cartItems', 'totalPrice'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $cartItems = $user->cartItems()->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('home');
        }

        // --- New Advanced Stock Validation ---
        $stockErrors = [];
        foreach ($cartItems as $cartItem) {
            // Check if the requested quantity is more than what's in stock
            if ($cartItem->product->stock < $cartItem->quantity) {
                // Add the item's ID and the available stock to our error list
                $stockErrors[$cartItem->id] = $cartItem->product->stock;
            }
        }

        // If the error list is NOT empty, redirect back with the errors
        if (!empty($stockErrors)) {
            return redirect()->route('cart.index')
                ->with('error', 'Some items in your cart have insufficient stock. Please adjust the quantities.')
                ->with('stock_errors', $stockErrors);
        }
        // --- End of New Validation ---

        // If we reach here, all stock is fine. Proceed with the order.
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
        ]);

        $totalPrice = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        // Create the Order
        $order = Order::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'address' => $request->address,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        // Create OrderItems and decrement stock
        foreach ($cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product->price,
            ]);

            $cartItem->product->decrement('stock', $cartItem->quantity);
            $cartItem->delete();
        }

        return redirect()->route('checkout.success');
    }

    public function success()
    {
        return view('checkout.success');
    }
}

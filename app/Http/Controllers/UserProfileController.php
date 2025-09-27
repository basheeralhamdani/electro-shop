<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    /**
     * Display a list of the authenticated user's orders.
     */
    public function orders()
    {
        // Fetch orders belonging only to the currently logged-in user
        $orders = Auth::user()->orders()->latest()->paginate(10);

        return view('user.orders', compact('orders'));
    }

    /**
     * Display the specified order for the authenticated user.
     */
    public function showOrder(Order $order)
    {
        // **CRITICAL SECURITY CHECK**
        // This ensures a user cannot see another user's order by changing the URL.
        if (Auth::id() !== $order->user_id) {
            abort(403, 'ACCESS DENIED'); // Or redirect them with an error
        }

        // Eager load the product details for each item in the order
        $order->load('items.product');

        return view('user.order_details', compact('order'));
    }
}

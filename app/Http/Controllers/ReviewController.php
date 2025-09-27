<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $user = Auth::user();

        // --- Business Logic: Check if the user has purchased this product ---
        $hasPurchased = Order::where('user_id', $user->id)
            ->whereHas('items', function ($query) use ($product) {
                $query->where('product_id', $product->id);
            })
            ->exists();

        if (!$hasPurchased) {
            return redirect()->back()->with('error', 'You can only review products you have purchased.');
        }

        // Check if the user has already reviewed this product
        $existingReview = Review::where('user_id', $user->id)->where('product_id', $product->id)->exists();

        if ($existingReview) {
            return redirect()->back()->with('error', 'You have already reviewed this product.');
        }

        // Create the review
        Review::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Thank you for your review!');
    }
}

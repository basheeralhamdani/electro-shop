<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        $categories = Category::all();

        

        return view('home', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    public function show(Product $product)
    {
        // Eager load reviews and the user associated with each review
        $product->load('category', 'reviews.user');

        // Calculate average rating
        $averageRating = $product->reviews->avg('rating');

        return view('product.show', compact('product', 'averageRating'));
    }

    // Inside HomeController

public function search(Request $request)
{
    // Validate the search query
    $request->validate([
        'q' => 'required|string|min:2',
    ]);

    $query = $request->input('q');

    // Search for products where the name is LIKE the query
    $products = Product::where('name', 'LIKE', "%{$query}%")
                        ->orWhere('description', 'LIKE', "%{$query}%")
                        ->paginate(12); // Use pagination for results

    return view('search.results', compact('products', 'query'));
}
}
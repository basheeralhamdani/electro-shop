<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Auth::user()->cartItems()->with('product')->get();
        $totalPrice = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
        return view('cart.index', compact('cartItems', 'totalPrice'));
    }

    public function add(Request $request, Product $product)
    {
        // ... (This method remains the same and is still correct for AJAX)
        if ($product->stock <= 0) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Sorry, this product is out of stock.']);
            }
            return redirect()->back()->with('error', 'Sorry, this product is out of stock.');
        }

        $user = Auth::user();
        $cartItem = $user->cartItems()->where('product_id', $product->id)->first();

        if ($cartItem) {
            if ($cartItem->quantity + 1 > $product->stock) {
                if ($request->ajax()) {
                    return response()->json(['success' => false, 'message' => 'Cannot add more items than available in stock.']);
                }
                return redirect()->back()->with('error', 'Cannot add more items than available in stock.');
            }
            $cartItem->increment('quantity');
        } else {
            CartItem::create(['user_id' => $user->id, 'product_id' => $product->id, 'quantity' => 1,]);
        }

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Product added to cart!', 'cartCount' => $user->cartItems()->count()]);
        }

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    /**
     * NEW METHOD: Update all cart item quantities at once.
     */
    public function updateAll(Request $request)
    {
        $request->validate(['quantities' => 'required|array']);

        $user = Auth::user();
        $stockErrors = [];

        foreach ($request->quantities as $cartItemId => $quantity) {
            $cartItem = CartItem::where('id', $cartItemId)->where('user_id', $user->id)->first();

            if ($cartItem && $quantity > 0) {
                // Check for stock issues
                if ($cartItem->product->stock < $quantity) {
                    $stockErrors[$cartItemId] = $cartItem->product->stock;
                } else {
                    $cartItem->update(['quantity' => $quantity]);
                }
            }
        }

        if (!empty($stockErrors)) {
            return redirect()->route('cart.index')
                ->with('error', 'Some items in your cart have insufficient stock. Please adjust the quantities.')
                ->with('stock_errors', $stockErrors);
        }

        return redirect()->route('cart.index')->with('success', 'Cart updated successfully!');
    }

    /**
     * MODIFIED METHOD: Remove an item from the cart.
     */
    public function remove(CartItem $cartItem)
    {
        // Ensure the user owns this cart item
        if ($cartItem->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        $cartItem->delete();
        return redirect()->route('cart.index')->with('success', 'Product removed from cart successfully!');
    }
}

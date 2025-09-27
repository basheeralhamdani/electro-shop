<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest; // <-- Import Update request
use Illuminate\Support\Facades\File; // <-- Import File facade for deleting images

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10); 
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(StoreProductRequest $request)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('image'), $imageName);
            $validatedData['image'] = $imageName;
        }

        Product::create($validatedData);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($product->image && File::exists(public_path('image/' . $product->image))) {
                File::delete(public_path('image/' . $product->image));
            }

            // Upload new image
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('image'), $imageName);
            $validatedData['image'] = $imageName;
        }

        $product->update($validatedData);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        // Delete the product image from the public folder
        if ($product->image && File::exists(public_path('image/' . $product->image))) {
            File::delete(public_path('image/' . $product->image));
        }

        // Delete the product from the database
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }
}
<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'product_name' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Upload image and save product details
        $imagePath = $request->file('image')->store('product_images', 'public');

        $product = new Product();
        $product->product_name = $request->input('product_name');
        $product->price = $request->input('price');
        $product->image = $imagePath;
        $product->save();

        return redirect()->route('dashboard.product.create')->with('success', 'Product added successfully.');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        // Validate input
        $request->validate([
            'product_name' => 'required',
            'price' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update product details
        $product->product_name = $request->input('product_name');
        $product->price = $request->input('price');

        if ($request->hasFile('image')) {
            // Upload new image
            $imagePath = $request->file('image')->store('product_images', 'public');
            $product->image = $imagePath;
        }

        $product->save();

        return redirect()->route('dashboard.product.edit', $product)->with('success', 'Product updated successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    
    public function index()
    {
        $products = Product::all();

        
        if (request()->wantsJson()) {
            return response()->json($products);
        }

        
        return view('products.index', compact('products'));
    }

    
    public function create()
    {
        return view('products.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name_product' => 'required|string|max:100',
            'quantity' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0'
        ]);

        $product = Product::create($request->only(['name_product', 'quantity', 'price']));

        
        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Product data saved successfully',
                'product' => $product
            ], 201);
        }

        
        return redirect()->route('products.index')->with('message', 'Product added successfully.');
    }

    
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    
    public function update(Request $request, $id)
    {
        $request->validate([
            'name_product' => 'required|string|max:100',
            'quantity' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0'
        ]);

        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->update($request->only(['name_product', 'quantity', 'price']));

        
        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Product data updated successfully',
                'product' => $product,
            ], 200);
        }

        
        return redirect()->route('products.index')->with('message', 'Product updated successfully.');
    }

    
    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->delete();

        
        if (request()->wantsJson()) {
            return response()->json(['message' => 'Product data has been successfully deleted']);
        }

        // Jika request dari web, redirect ke daftar produk
        return redirect()->route('products.index')->with('message', 'Product deleted successfully.');
    }
}

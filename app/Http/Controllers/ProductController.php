<?php

namespace App\Http\Controllers;

use App\Models\Product;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // fetch data
    public function index()
    {
        return response()->json(Product::all());
    }

    // store penyimpanan data poduct
    public function store(Request $request)
    {
        $request->validate([
            'name_product' => 'required|string|max:100',
            'quantity' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0'
    ]);

    $product = Product::create([
        'name_product' => $request->name_product,
        'quantity' => $request->quantity,
        'price' => $request->price,
    ]);

    return response()->json([
        'Message' => 'Product data saved successfully',
        'Product' => $product
    ], 201);

    }

    // destroy data product per id
    public function destroy($id)
    {
        Product::destroy($id);
        return response()->json(['messsage' => 'Product data has been successfully deleted']);
    }

    // update data product berdasarkan id
    public function update(Request $request, $id) {

        // validasi input
        $request->validate([
            'name_product' => 'required|string|max:100',
            'quantity' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0'
        ]);

        // cari product berdasarkan id
        $product = Product::find($id);
        if(!$product) {
            return response()->json([
                'messsage' => 'Data not found',
            ], 404);
        }

        // update data product
        $product->update([
            'name_product' => $request->name_product,
        'quantity' => $request->quantity,
        'price' => $request->price,
        ]);

        return response()->json([
            'messsage' => 'Product data updated successfully',
            'Product' => $product,
        ],200);
    }
}

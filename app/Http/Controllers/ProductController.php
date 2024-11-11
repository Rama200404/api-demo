<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Get All Products
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    // Get Single Product
    public function show($id)
    {
        $product = Product::find($id);
        if ($product) {
            return response()->json($product);
        }
        return response()->json(['message' => 'Product not found'], 404);
    }

    // Create New Product
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0.01',
        ]);

        $product = Product::create($validatedData);
        return response()->json($product, 201);
    }

    // Update Product
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if ($product) {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric|min:0.01',
            ]);

            $product->update($validatedData);
            return response()->json($product);
        }
        return response()->json(['message' => 'Product not found'], 404);
    }

    // Delete Product
    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            return response()->json(['message' => 'Product deleted']);
        }
        return response()->json(['message' => 'Product not found'], 404);
    }
}

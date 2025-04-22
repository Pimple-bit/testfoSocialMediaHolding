<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json(Product::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'brand' => 'nullable|string',
            'category' => 'nullable|string',
            'thumbnail' => 'nullable|url',
        ]);

        $product = Product::create($validated);

        return response()->json($product, 201);
    }
}

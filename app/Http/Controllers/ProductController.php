<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    // 20 produk dummy
    private $products = [];

    public function __construct()
    {
        // Generate 20 produk random
        for ($i = 1; $i <= 20; $i++) {
            $this->products[] = [
                'id' => $i,
                'name' => "Product $i",
                'description' => "Description for product $i",
                'price' => rand(10, 1000),
            ];
        }
    }

    public function index()
    {
        $products = $this->products;
        return view('products.list', compact('products'));
    }

    public function create()
    {
        return view('products.form');
    }

    public function edit($id)
    {
        $product = collect($this->products)->firstWhere('id', $id);
        if (!$product) abort(404);
        return view('products.form', compact('product'));
    }

    public function store(Request $request)
    {
        // Dummy store logic (just redirect back with success)
        return redirect()->route('products')->with('success', 'Product stored!');
    }

    public function update(Request $request, $id)
    {
        // Dummy update logic
        return redirect()->route('products')->with('success', 'Product updated!');
    }

    public function show($id)
    {
        $product = collect($this->products)->firstWhere('id', $id);
        if (!$product) abort(404);
        return view('products.show', compact('product'));
    }
}

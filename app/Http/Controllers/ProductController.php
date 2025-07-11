<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function home()
    {
        $featuredProducts = Product::with('category')->inRandomOrder()->take(5)->get();
        return view('products.home', compact('featuredProducts'));
    }

    public function index(Request $request)
    {
        $query = Product::query()->with('category');

        // Search by name or description
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('description', 'like', '%' . $searchTerm . '%');
            });
        }

        // Filter by price range
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Filter by category
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Sorting
        $sortBy = $request->input('sort_by', 'name'); // Default sort by name
        $sortDirection = $request->input('sort_direction', 'asc'); // Default sort direction asc

        if (!in_array($sortBy, ['name', 'price', 'created_at'])) {
            $sortBy = 'name'; // Fallback to default
        }
        if (!in_array(strtolower($sortDirection), ['asc', 'desc'])) {
            $sortDirection = 'asc'; // Fallback to default
        }
        $query->orderBy($sortBy, $sortDirection);

        $products = $query->paginate(10)->withQueryString(); // Keeps query params on pagination links
        $categories = Category::orderBy('name')->get();

        return view('products.list', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('products.form', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        Product::create($request->all());

        return redirect()->route('products')->with('success', 'Product created successfully!');
    }

    public function show(Product $product)
    {
        $product->load('category');

        // Cek status wishlist untuk pengguna yang sedang login
        $isInWishlist = Auth::check() ? Auth::user()->wishlistItems()->where('product_id', $product->id)->exists() : false;

        return view('products.show', compact('product', 'isInWishlist'));
    }

    public function edit(Product $product) // Route model binding
    {
        $categories = Category::orderBy('name')->get();
        return view('products.form', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product) // Route model binding
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product->update($request->all());

        return redirect()->route('products')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product) // Route model binding
    {
        $product->delete();
        return redirect()->route('products')->with('success', 'Product deleted successfully!');
    }
}

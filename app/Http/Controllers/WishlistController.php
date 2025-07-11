<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\WishlistItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    // Menampilkan halaman wishlist
    public function index()
    {
        $wishlistItems = Auth::user()->wishlistItems()->with('product.category')->latest()->get();
        return view('wishlist.index', compact('wishlistItems'));
    }

    // Menambah atau menghapus produk dari wishlist
    public function toggle(Product $product)
    {
        if (!Auth::check()) {
            return response()->json(['status' => 'error', 'message' => 'Login is required.'], 401);
        }

        $user = Auth::user();
        $wishlistItem = WishlistItem::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->first();

        if ($wishlistItem) {
            $wishlistItem->delete();
            return response()->json([
                'status' => 'removed',
                'message' => 'Produk dihapus dari wishlist.'
            ]);
        } else {
            WishlistItem::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
            ]);
            return response()->json([
                'status' => 'added',
                'message' => 'Produk ditambahkan ke wishlist!'
            ]);
        }
    }
}

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
        $user = Auth::user();

        $wishlistItem = WishlistItem::where('user_id', $user->id)
                                    ->where('product_id', $product->id)
                                    ->first();

        if ($wishlistItem) {
            // Jika sudah ada, hapus dari wishlist
            $wishlistItem->delete();
            return back()->with('success', 'Product removed from your wishlist.');
        } else {
            // Jika belum ada, tambahkan ke wishlist
            WishlistItem::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
            ]);
            return back()->with('success', 'Product added to your wishlist!');
        }
    }
}
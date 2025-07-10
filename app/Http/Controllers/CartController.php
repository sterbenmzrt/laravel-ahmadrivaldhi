<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Menampilkan halaman keranjang belanja
    public function index()
    {
        $cartItems = Auth::user()->cartItems()->with('product')->get();
        $subtotal = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });

        return view('cart.index', compact('cartItems', 'subtotal'));
    }

    // Menambahkan produk ke keranjang
    public function add(Request $request, Product $product)
    {
        // Gunakan validasi baru
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'final_price' => 'required|numeric|min:0',
        ]);

        $cartItem = CartItem::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            $cartItem->update([
                'quantity' => $request->quantity,
                'price' => $request->final_price, // Simpan harga per anggota
            ]);
        } else {
            // Buat item keranjang baru dengan harga dinamis
            CartItem::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $request->quantity,
                'price' => $request->final_price, // Simpan harga per anggota
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Product added to cart!');
    }

    // Mengubah jumlah produk
    public function update(Request $request, CartItem $cartItem)
    {
        // Pastikan user hanya bisa mengubah item miliknya
        if ($cartItem->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate(['quantity' => 'required|integer|min:1']);
        $cartItem->update(['quantity' => $request->quantity]);

        return back()->with('success', 'Cart updated successfully!');
    }

    // Menghapus produk dari keranjang
    public function remove(CartItem $cartItem)
    {
        // Pastikan user hanya bisa menghapus item miliknya
        if ($cartItem->user_id !== Auth::id()) {
            abort(403);
        }

        $cartItem->delete();
        return back()->with('success', 'Product removed from cart.');
    }
}

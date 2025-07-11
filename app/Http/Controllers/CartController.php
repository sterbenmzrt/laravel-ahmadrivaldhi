<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use App\Models\Coupon; // <-- Tambahkan ini
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session; // <-- Tambahkan ini

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Auth::user()->cartItems()->with('product')->get();
        $subtotal = $cartItems->sum(fn ($item) => $item->quantity * $item->product->price);

        // Logika untuk menghitung diskon dari kupon di session
        $discount = 0;
        if (Session::has('coupon')) {
            $coupon = Session::get('coupon');
            if ($coupon->type == 'percent') {
                $discount = ($coupon->value / 100) * $subtotal;
            } else {
                $discount = $coupon->value;
            }
        }

        $total = $subtotal - $discount;

        // Kirim semua data ke view, termasuk diskon dan total
        return view('cart.index', compact('cartItems', 'subtotal', 'discount', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
            'final_price' => 'sometimes|required|numeric|min:0',
        ]);
        $user = Auth::user();
        $cartItem = CartItem::where('user_id', $user->id)->where('product_id', $product->id)->first();
        $price = $validated['final_price'] ?? $product->price;

        if ($cartItem) {
            $cartItem->increment('quantity', $validated['quantity']);
        } else {
            CartItem::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'quantity' => $validated['quantity'],
                'price' => $price,
            ]);
        }
        $user->wishlistItems()->where('product_id', $product->id)->delete();
        if ($request->expectsJson()) {
            return response()->json(['message' => 'Produk berhasil ditambahkan ke keranjang!']);
        }
        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function update(Request $request, CartItem $cartItem)
    {
        if ($cartItem->user_id !== Auth::id()) { abort(403); }
        $request->validate(['quantity' => 'required|integer|min:1']);
        $cartItem->update(['quantity' => $request->quantity]);
        return back()->with('success', 'Keranjang berhasil diperbarui!');
    }

    public function remove(CartItem $cartItem)
    {
        if ($cartItem->user_id !== Auth::id()) { abort(403); }
        $cartItem->delete();
        return back()->with('success', 'Produk dihapus dari keranjang.');
    }

    /**
     * Menerapkan kode kupon.
     */
    public function applyCoupon(Request $request)
    {
        $coupon = Coupon::where('code', $request->coupon_code)
                        ->where(function ($query) {
                            $query->where('expires_at', '>=', now())
                                  ->orWhereNull('expires_at');
                        })
                        ->first();

        if (!$coupon) {
            return back()->with('error', 'Kupon tidak valid atau sudah kedaluwarsa.');
        }

        Session::put('coupon', $coupon);
        return back()->with('success', 'Kupon berhasil diterapkan!');
    }

    /**
     * Menghapus kupon yang diterapkan.
     */
    public function removeCoupon()
    {
        Session::forget('coupon');
        return back()->with('success', 'Kupon telah dihapus.');
    }
}

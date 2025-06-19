<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    // Menampilkan halaman checkout
    public function create()
    {
        $user = Auth::user();
        $cartItems = $user->cartItems()->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $subtotal = $cartItems->sum(fn($item) => $item->quantity * $item->product->price);
        $addresses = $user->addresses; // Ambil alamat yang sudah ada

        return view('checkout.create', compact('cartItems', 'subtotal', 'addresses'));
    }

    // Memproses pembelian
    public function store(Request $request)
    {
        $request->validate([
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'payment_method' => 'required|string',
        ]);

        $user = Auth::user();
        $cartItems = $user->cartItems;

        if ($cartItems->isEmpty()) {
            return redirect()->route('products')->with('error', 'Your cart is empty.');
        }

        // Gunakan DB Transaction untuk memastikan semua query berhasil
        DB::beginTransaction();

        try {
            // 1. Simpan alamat baru
            $address = Address::create([
                'user_id' => $user->id,
                'street' => $request->street,
                'city' => $request->city,
                'state' => $request->state,
                'postal_code' => $request->postal_code,
            ]);

            // 2. Hitung total
            $total = $cartItems->sum(fn($item) => $item->quantity * $item->product->price);

            // 3. Buat Order
            $order = Order::create([
                'user_id' => $user->id,
                'address_id' => $address->id,
                'total_amount' => $total,
                'payment_method' => $request->payment_method,
                'status' => 'processing',
            ]);

            // 4. Pindahkan item dari keranjang ke order items
            foreach ($cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->product->price, // simpan harga saat ini
                ]);
            }

            // 5. Kosongkan keranjang belanja
            $user->cartItems()->delete();

            DB::commit();

            return redirect()->route('orders.show', $order)->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            // Opsional: log error $e->getMessage()
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}

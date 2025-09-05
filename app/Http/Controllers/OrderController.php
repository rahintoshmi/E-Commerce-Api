<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return Order::with('product')->get();
    }

    // Place order
    public function store(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        if ($product->stock < $request->quantity) {
            return response()->json(['message' => 'Not enough stock'], 400);
        }

        $total = $product->price * $request->quantity;

        $order = Order::create([
            'user_id' => 1, // for now, fixed user
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'total_price' => $total,
        ]);

        // reduce stock
        $product->decrement('stock', $request->quantity);

        return response()->json($order, 201);
    }
}

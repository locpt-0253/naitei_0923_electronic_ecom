<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartProducts = Auth::user()->cartProducts;
        $totalAmount = 0;

        foreach ($cartProducts as $product) {
            $totalAmount += $product->price * $product->pivot->quantity;
        }
        
        return view('cart.index', [
            'cartProducts' => $cartProducts,
            'totalAmount' => $totalAmount,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'quantity' => ['required', 'numeric', 'min:1', 'max:100'],
            'product_id' => ['required', 'exists:products,id'],
        ]);

        $cart = Cart::where([
            'product_id' => $request->product_id,
            'user_id' => auth()->user()->id,
        ])->first();

        if (!$cart) {
            auth()->user()->cartProducts()->attach($request->product_id, [
                'quantity' => $request->quantity,
            ]);
        } else {
            $cart->quantity += $request->quantity;
            $cart->save();
        }
        
        return redirect()->back();
    }

    public function update(Cart $cart, Request $request)
    {
        $currentQuantity = $request->quantity;
        if ($request->increment) {
            $cart->quantity = $currentQuantity + 1;
            $cart->save();
        } elseif ($request->decrement && $currentQuantity > 1) {
            $cart->quantity = $currentQuantity - 1;
            $cart->save();
        } elseif ($request->decrement && $currentQuantity == 1 || $currentQuantity == 0) {
            $cart->delete();
        }
        
        return redirect()->back();
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();

        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\Bill;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function __invoke(CheckoutRequest $request)
    {
        $validatedData = $request->validated();

        try {
            DB::beginTransaction();

            $user = Auth::user();

            $cartProducts = Cart::where('user_id', $user->id)->with('product')->get();

            if ($cartProducts->isEmpty()) {
                return back()->withErrors(__('There are no items in the shopping cart.'));
            }

            $order = new Order();
            $order->order_date = now();
            $order->status = config('app.order_status')['processing'];
            $order->delivery_id = $validatedData['address_id'];
            $order->user_id = $user->id;
            $order->save();

            $totalAmount = 0;
            foreach ($cartProducts as $cartProduct) {
                if ($cartProduct->quantity > $cartProduct->product->stock_quantity) {
                    DB::rollback();

                    return back()->withErrors(__('The :product_name is out of stock', [
                        'product_name' => $cartProduct->product->name,
                    ]));
                }

                $totalAmount += $cartProduct->product->price * $cartProduct->quantity;
                $order->products()->attach($cartProduct->product_id, [
                    'quantity' => $cartProduct->quantity,
                ]);
                $cartProduct->product->sold_quantity += $cartProduct->quantity;
                $cartProduct->product->save();
            }

            $bill = new Bill();
            $bill->payment_method = $validatedData['payment_method'];
            $bill->total = $totalAmount;
            $bill->order_id = $order->id;
            $bill->save();

            Cart::where('user_id', $user->id)->delete();

            DB::commit();

            return back()->with('success', __('Create :resource :status', [
                'resource' => __('Order'),
                'status' => __('Success'),
            ]));
        } catch (\Exception $e) {
            DB::rollback();

            return back()->withErrors(__('Error when :action the :resource', [
                'action' => __('Checkout'),
                'resource' => __('Order'),
            ]));
        }
    }
}

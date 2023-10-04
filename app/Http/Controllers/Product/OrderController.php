<?php

namespace App\Http\Controllers\Product;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(OrderRequest $request)
    {
        $request->validated();

        $status = $request->status;
        $user = Auth::user();
        $orders = Order::with('products', 'bill', 'address')
            ->where('user_id', $user->id)
            ->when($status, function ($query) use ($status) {
                return $query->where('status', config('app.order_status')[$status]);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(config('constants.orders_paginate'));

        return view('customer.order.index', [
            'orders' => $orders,
        ]);
    }

    public function update(Order $order)
    {
        if ($order->status != config('app.order_status')['processing']) {
            abort(403);
        }

        $order->status = config('app.order_status')['canceled'];
        $order->save();

        alert()->success(__('Success'), __('Order cancelled successfully'));

        return redirect()->back();
    }
}

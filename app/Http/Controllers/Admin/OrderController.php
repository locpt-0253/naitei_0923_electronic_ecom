<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\ChangeStatusRequest;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('products', 'address')->paginate(config('app.admin_page_pagination_size'));

        return view('admin.orders.index', [
            'orders' => $orders,
        ]);
    }

    public function changeStatus(ChangeStatusRequest $request, Order $order)
    {
        $validatedData = $request->validated();

        $order->status = $validatedData['status'];
        $order->save();

        return redirect()
            ->back()
            ->with('success', __('Update :resource :status', [
                'resource' => __('Status'),
                'status' => __('Success'),
            ]));
    }
}

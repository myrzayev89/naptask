<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $orders = Order::where('date', date('Y-m-d'))->where('status', 0)->get();
        return view('order.index', compact('orders'));
    }

    public function items($id)
    {
        $order = Order::where('id', $id)->where('status', 0)->firstOrFail();
        $orderItems = $order->orderItems;
        return view('order.items', compact('orderItems'));
    }

    public function check(Request $request)
    {
        Order::where('id', $request->id)->update(['status' => 1]);
        session()->flash('success', 'Sifariş Təsdiqləndi');
    }
}

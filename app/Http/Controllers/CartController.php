<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('cart');
    }

    public function update(Request $request)
    {
        if($request->id && $request->qty) {
            $cart = session()->get('cart');
            $cart[$request->id]['qty'] = $request->qty;
            session()->put('cart', $cart);
            session()->flash('success', 'Redakte edildi');
        }
    }

    public function delete(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Silindi');
        }
    }

    public function checkout(Request $request)
    {
        $cartItems = session()->get('cart');
        $order = Order::create(['date' => Carbon::now()]);
        if ($order) {
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'name' => $item['name'],
                    'price' => $item['price'],
                    'qty' => $item['qty'],
                    'subtotal' => $item['qty'] * $item['price'],
                ]);
            }
        }
        session()->flush();
        session()->flash('success', 'Sifariş Tamamlandı');
    }
}

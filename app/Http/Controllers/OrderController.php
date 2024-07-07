<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Auth::user()->orders()->get()->all();
        return view('orders.index')->with('orders', $orders);
    }

    public function create()
    {
        $cart = Auth::user()->cart()->first();
        return view('orders.create')->with('cart', $cart);
    }

    public function store(Request $req)
    {
        $validations = $req->validate(
            [
                "delivery" => "required|min:1|max:2",
                "surname" => 'required',
                "name" => 'required',
                "phone" => 'required',
                "email" => "required|email",
                "payment" => "required|min:1|max:2",
            ],
            ['required' => 'Поле :attribute обязательное']
        );

        $cart = Auth::user()->cart()->first();

        $products = $cart->products()->get()->all();

        if (empty($products)) {
            return redirect()->route('cart');
        }

        $validations["delivery"] = $validations["delivery"] == 1 ? 'Самовывоз (Москва)' : 'Самовывоз (Истра)';
        $validations["payment"] = $validations["payment"] == 1 ? 'Прямой банковский перевод' : ' Оплата при доставке';
        $validations["user_id"] = Auth::id();
        $validations["total_price"] = $cart->getTotal();

        $order = Order::create($validations);

        foreach ($products as $product) {
            $order->products()->attach($product, ['count' => $product->pivot->count]);
        }

        $cart->clear();

        return redirect()->route('profile.orders');
    }

    public function updateStatus(Order $order, $status)
    {
        if ($order->status_id >= 3) {
            abort(403);
        }

        $order->update(
            ['status_id' => $status]
        );
    }

    public function delivered(Order $order)
    {
        $this->updateStatus($order, 2);
        return redirect()->route('orders');
    }
    public function paid(Order $order)
    {
        $this->updateStatus($order, 3);
        return redirect()->route('orders');
    }
    public function cancel(Order $order)
    {
        $this->updateStatus($order, 4);
        return redirect()->route('orders');
    }
}

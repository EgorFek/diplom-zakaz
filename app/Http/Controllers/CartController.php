<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = Auth::user()->cart()->first();

        $totalPrice = $cart->getTotal($cart);

        return view('users.cart')->with([
            'cart' => $cart,
            'totalPrice' => $totalPrice
        ]);
    }

    public function add(Product $product, Request $request)
    {
        $validations = $request->validate(['count' => 'required|min:1|integer']);
        $cart = Auth::user()->cart()->first();

        $existingProduct =  $cart->products()->find($product->id);

        if ($existingProduct) {
            $newCount = $existingProduct->pivot->count + $validations['count'];
            $cart->products()->updateExistingPivot($product->id, ['count' => $newCount]);
        } else {
            $cart->products()->attach($product, ['count' => $validations['count']]);
        }
        return redirect()->route('cart');
    }

    public function edit(Product $product, $count)
    {
        $cart = Auth::user()->cart()->first();

        $existingProduct =  $cart->products()->find($product->id);
        if (!$existingProduct) {
            abort(403);
        }

        $newCount = $existingProduct->pivot->count + $count > 0 ? $existingProduct->pivot->count + $count : 1;
        $cart->products()->updateExistingPivot($product->id, ['count' => $newCount]);
    }

    public function decrease(Product $product)
    {
        $this->edit($product, -1);

        return redirect()->back();
    }
    public function increase(Product $product)
    {
        $this->edit($product, 1);

        return redirect()->back();
    }

    public function remove(Product $product)
    {

        $cart = Auth::user()->cart()->first();

        $existingProduct =  $cart->products()->find($product->id);
        if (!$existingProduct) {
            abort(403);
        }

        $cart->products()->detach($product->id);

        return redirect()->back();
    }

    public function clear()
    {
        Auth::user()->cart()->first()->clear();
        return redirect()->back();
    }
}

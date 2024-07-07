<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile()
    {
        return view('users.profile');
    }

    public function update(Request $req)
    {
        $validations = $req->validate([
            'nick' => 'required',
            'email' => 'required|email',
        ], ['required' => 'Поле :attribute обязательно для заполнения', 'email' => "Некорректная почта"]);

        if ($validations['email'] != Auth::user()->email && User::where('email', $validations['email'])->first()) {
            return redirect()->route('profile')->withErrors(['email' => "Эта почта уже занята"]);
        }

        Auth::user()->update($validations);
        return redirect()->route('profile');
    }

    public function orders()
    {
        $orders = Auth::user()->orders()->orderByDesc('created_at')->get();
        return view('users.orders', compact('orders'));
    }

    public function favourites()
    {
        $products = Auth::user()->products()->paginate(12);
        return view('users.fav', compact('products'));
    }

    public function addFavourites(Request $req)
    {
        $product = Product::findOrFail($req->input('product_id'));

        if (!Auth::user()->products()->find($product->id)) {
            Auth::user()->products()->attach($product->id);
        }
        return redirect()->route('favourite');
    }

    public function removeFavourites(Product $product)
    {
        Auth::user()->products()->detach($product->id);
        return redirect()->route('favourite');
    }
}

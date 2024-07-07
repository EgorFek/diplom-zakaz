<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function store(Request $req, Product $product)
    {
        $validations = $req->validate([
            'text' => 'required|min:1|max:1000'
        ]);

        $validations['user_id'] = Auth::id();
        $validations['product_id'] = $product->id;

        Feedback::create($validations);

        return redirect()->back();
    }
}

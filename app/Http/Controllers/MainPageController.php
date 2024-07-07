<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class MainPageController extends Controller
{
    public function index(Request $req)
    {
        Paginator::useBootstrapFive();
        $products = Product::orderByDesc('created_at');

        $search = $req->input('search');

        if (isset($search)) {

            $category = ProductCategory::where('category', 'LIKE',  '%' . $search . '%')->first();

            if (!empty($category)) {
                $products = $products->where('category_id', $category->id);
            } else {
                $products = $products->where('name', 'LIKE', '%' . $search . '%');
            }
        }

        $products = $products->paginate(12);

        $actions = Action::orderByDesc('created_at')->where('is_avaliable', 1)->get();

        return view('main')->with(compact('products'))->with(compact('actions'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        Paginator::useBootstrapFive();
        $products = Product::orderByDesc('created_at')->paginate(12);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = ProductCategory::get();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validations = $request->validate([
            'name' => 'required|min:1|max:255',
            'image' => 'required|image',
            'description' => 'required|max:1000',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'discount' => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
            'category_id' => 'required|exists:product_categories,id'
        ]);

        $fileName = $request->file('image')->store('products', 'public');

        $validations['image'] = $fileName;

        Product::create($validations);

        return redirect()->route('products');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = ProductCategory::get();
        return view('products.edit')->with(compact('product'))->with(compact('categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validations = $request->validate([
            'name' => 'required|min:1|max:255',
            'image' => 'nullable|image',
            'description' => 'required|max:1000',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'discount' => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
            'category_id' => 'required|exists:product_categories,id'
        ]);

        if (isset($validations['image'])) {

            Storage::disk('public')->delete($product->image);

            $fileName = $request->file('image')->store('products', 'public');

            $validations['image'] = $fileName;
        }

        $product->update($validations);

        return redirect()->route('products');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('products');
    }
}

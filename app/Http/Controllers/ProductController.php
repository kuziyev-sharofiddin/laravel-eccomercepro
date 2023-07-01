<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;

use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        return view('admin.show_products')->with([
            'products' => Product::all(),
        ]);;
    }


    public function create()
    {
        return view('admin.add_product')->with([
            'categories' => Category::all(),
        ]);;
    }


    public function store(Request $request)
    {
        if ($request->hasFile('image')){
            $name = $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('product-images', $name);
        }


        $post = Product::create([
            // 'user_id'=>auth()->user()->id,
            "category_id"=>$request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'discount_price' => $request->discount_price,
            'image' => $path ?? null,
        ]);

        return redirect()->route('products.index');
    }



    public function edit(string $id)
    {

    }

    public function update(Request $request, string $id)
    {

    }


    public function destroy(string $id)
    {

    }
}

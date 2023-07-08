<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        return view('admin.show_products')->with([
            'products' => Product::all(),
        ]);
    }


    public function create()
    {
        return view('admin.add_product')->with([
            'categories' => Category::all(),
        ]);
    }


    public function store(Request $request)
    {
        if(Auth::id())
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
        else
        {
            return redirect('login');
        }
    }



    public function edit(Product $product)
    {
        return view('admin.edit_product')->with([
            'product'=>$product,
            'categories' => Category::all()]);
    }

    public function update(Request $request, Product $product)
    {
        // Gate::authorize('update-post', $post);

        if(Auth::id())
        {
            if ($request->hasFile('image')){

                if (isset($product->image)){
                    Storage::delete($product->image);
                }

                $name = $request->file('image')->getClientOriginalName();
                $path = $request->file('image')->storeAs('product-images', $name);
            }

            $product->update([
                // 'user_id'=>auth()->user()->id,
                "category_id"=>$request->category_id,
                'title' => $request->title,
                'description' => $request->description,
                'quantity' => $request->quantity,
                'price' => $request->price,
                'discount_price' => $request->discount_price,
                'photo' => $path ?? $product->image,

            ]);
            return redirect()->route('products.index', ['product' => $product->id]);
        }
        else
        {
            return redirect('login');
        }
    }


    public function destroy(Product $product)
    {
        if(Auth::id()){
            if (isset($product->image)){
                Storage::delete($product->image);
            }

            $product->delete();
            return redirect()->route('products.index');
        }
        else
        {
            return redirect('login');
        }

    }
}

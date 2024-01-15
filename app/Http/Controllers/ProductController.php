<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use Illuminate\Support\Facades\Auth;
use App\Service\ProductService;

class ProductController extends Controller
{
    public function __construct(protected ProductService $productservice)
    {

    }

    public function show()
    {

        $products = $this->productservice->getByPaginate(10);
        return view('admin.show_products')->with([
            'products' => $products,
        ]);
    }
    public function create()
    {
        $categories = $this->productservice->getByCategoryPaginate(10);
        return view('admin.add_product')->with([
            'categories' => $categories,
        ]);
    }


    public function store(ProductRequest $request)
    {
        if(Auth::id())
        {
            $this->productservice->create($request->all());
            return redirect()->route('products.index');
        }
        else
        {
            return redirect('login');
        }
    }



    public function edit($product,$limit)
    {
        $product = $this->productservice->getById($product);
        $categories = $this->productservice->getByCategoryPaginate($limit);
        return view('admin.edit_product')->with([
            'product'=>$product,
            'categories' => $categories,
        ]);
    }

    public function update(ProductUpdateRequest $request, $product)
    {
        if(Auth::id())
        {
            $product = $this->productservice->update($product,$request->all());
            return redirect()->route('products.index', ['product' => $product]);
        }
        else
        {
            return redirect('login');
        }
    }


    public function destroy($product)
    {
        if(Auth::id()){
            $this->productservice->destroy($product);
            return redirect()->route('products.index');
        }
        else
        {
            return redirect('login');
        }
    }
}

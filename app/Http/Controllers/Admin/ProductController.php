<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use Illuminate\Support\Facades\Auth;
use App\Service\ProductService;
use App\Service\CategoryService;

class ProductController extends Controller
{
    public function __construct(protected ProductService $productservice, protected CategoryService $categoryService)
    {

    }

    public function header(){
        $categories = $this->categoryService->getByCategoryPaginate();
        return view('home.header')->with([
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        $categories = $this->categoryService->getByCategoryPaginate();
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

    public function show()
    {
        $products = $this->productservice->getByPaginate(10);
        return view('admin.show_products')->with([
            'products' => $products,
        ]);
    }


    public function edit($product)
    {
        $product = $this->productservice->getById($product);
        $categories = $this->categoryService->getByCategoryPaginate();
        return view('admin.edit_product')->with([
            'product'=>$product,
            'categories' => $categories,
        ]);
    }


    public function update(ProductUpdateRequest $request, $product)
    {
        if(Auth::id())
        {
            $product = $this->productservice->update($product,$request->validated());
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

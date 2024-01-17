<?php

namespace App\Http\Controllers;
use App\Service\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(protected ProductService $productService)
    {

    }
    public function searchProduct(Request $request){
        $products = $this->productService->getSearchProduct($request->search);
        return view('home.all_product')->with([
            'products' => $products,
        ]);
    }

    public function productCategory(Request $request){
        $products = $this->productService->getSearchProduct($request->search);
        return view('home.product_category')->with([
            'products' => $products,
        ]);
    }

    public function productDetails($product){
        $product = $this->productService->getById($product);
        return view('home.product_details')->with([
            'product'=> $product,
        ]);
    }
}

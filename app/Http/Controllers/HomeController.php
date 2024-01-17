<?php

namespace App\Http\Controllers;
use App\Service\ProductService;
class HomeController extends Controller
{

    public function __construct(protected ProductService $productService)
    {

    }
    public function index(){
        $products = $this->productService->getByPaginate(10);
        return view('home.userpage')->with([
            'products'=> $products,
        ]);
    }
}

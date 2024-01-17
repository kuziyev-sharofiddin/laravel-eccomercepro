<?php

namespace App\Http\Controllers;

use App\Service\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct(protected CartService $cartService)
    {

    }
    public function addCart(Request $request,$product,$cart){
        if(Auth::id()){
            $this->cartService->addCart($request, $product, $cart);
            return redirect()->back();
            }
        else
        {
            return redirect('login');
        }
    }

    public function showCart(){
        if(Auth::id()){
            $carts = $this->cartService->showCart();
            return view('home.show_cart')->with([
                'carts'=> $carts,
            ]);
            }
        else
        {
            return redirect('login');
        }
    }

    public function removeCart($cart){
        $this->cartService->removeCart($cart);
        return redirect()->back();

    }
}

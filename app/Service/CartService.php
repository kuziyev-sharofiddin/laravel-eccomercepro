<?php

namespace App\Service;

use App\Repository\CartRepository;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert as FacadesAlert;

class CartService
{
    protected CartRepository $repository;
    public function __construct(CartRepository $repository)
    {
        $this->repository = $repository;
    }

    public function addCart($data,$product,$cart){
            $id = Auth::user()->id;
            $product_exist_id = $this->repository->getProductExistsId($product,$id);
            if($product_exist_id)
            {
                $cart = $this->repository->getById($product_exist_id)->first();
                $quantity = $cart->quantity;
                $cart->quantity = $quantity + $data['quantity'];
                if($product->discount_price!=null)
                {
                    $cart->price = $product->discount_price * $cart->quantity;
                }
                else
                {
                    $cart->price = $product->price * $cart->quantity;
                }
                $cart->save();
                FacadesAlert::success('Product Added Successfully','We have added product to the cart');

                return redirect()->back();
            }
            else
            {
                $user = Auth::user();
                $cart->name = $user->name;
                $cart->email = $user->email;
                $cart->phone = $user->phone;
                $cart->address = $user->address;
                $cart->user_id = $user->id;
                $cart->product_title = $product->title;
                if($product->discount_price!=null)
                {
                    $cart->price = $product->discount_price * $data['quantity'];
                }
                else
                {
                    $cart->price = $product->price * $data['quantity'];
                }
                $cart->image = $product->image;
                $cart->product_id = $product->id;
                $cart->quantity = $data['quantity'];
                $cart->save();
                FacadesAlert::success('Product Added Successfully','We have added product to the cart');
                return redirect()->back();
            }
    }

    public function showCart(){
            $id = Auth::user()->id;
            return $this->repository->getUserId($id)->get();
    }


    public function removeCart($cart){
        return $this->repository->delete($cart);
    }
}

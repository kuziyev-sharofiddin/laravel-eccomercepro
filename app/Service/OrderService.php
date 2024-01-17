<?php

namespace App\Service;

use App\Repository\CartRepository;
use App\Repository\OrderRepository;
use Illuminate\Support\Facades\Auth;

class OrderService
{
    public function __construct(protected OrderRepository $repository, protected CartRepository $cartRepository)
    {

    }
    public function getSearchOrder($searchText)
    {
        return $this->repository->getSearchOrder($searchText);
    }

    public function getByStatus($order)
    {
        $order = $this->repository->getById($order);
        $order->delivery_status='delivered';
        $order->payment_status='Paid';
        $order->save();
        return $order;
    }

    public function getByPaginate($limit)
    {
        return $this->repository->paginate($limit);
    }

    public function getById($id)
    {
       return $this->repository->getById($id);
    }

    public function cancelOrder($order)
    {
        $order = $this->repository->getById($order);
        $order->delivery_status='You canceled the order';
        $order->save();
        return $order;
    }

    public function cashOrder($order){
        $id = Auth::user()->id;
        $carts = $this->cartRepository->getUserId($id);
        foreach($carts as $cart){
            $order = $this->repository->getById($order);
            $order->name = $cart->name;
            $order->email = $cart->email;
            $order->phone = $cart->phone;
            $order->address = $cart->address;
            $order->user_id = $cart->user_id;
            $order->product_title = $cart->product_title;
            $order->price = $cart->price;
            $order->quantity = $cart->quantity;
            $order->image = $cart->image;
            $order->product_id = $cart->product_id;
            $order->payment_status = 'cash on delivery';
            $order->delivery_status = 'processing';
            $order->save();

            $cart_id = $cart->id;
            $cartId = $this->cartRepository->getById($cart_id);
            $cartId->delete();
        }
        return $order;
    }
}

<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Service\OrderService;


class OrderController extends Controller
{
    public function __construct(protected OrderService $orderService)
    {

    }

    public function showOrder(){
        if(Auth::id())
        {
            $orders = $this->orderService->getByPaginate(10);
            return view('home.show_order')->with([
                'orders'=> $orders,
            ]);
        }
        else
        {
            return redirect('login');
        }
    }

    public function cancel_order($order){
        $this->orderService->cancelOrder($order);
        return redirect()->back();
    }

    public function cashOrder($order){
        $this->orderService->cashOrder($order);
        return redirect()->back()->with('message', 'We have Received your Order. We will connect with you soon...');
    }


}

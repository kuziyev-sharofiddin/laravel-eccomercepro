<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\OrderService;


class OrderController extends Controller
{
    public function __construct(protected OrderService $orderService)
    {

    }
    public function getOrderSearch(Request $request){
        $orders = $this->orderService->getSearchOrder($request->search);
        return view('admin.order')->with([
            'orders' => $orders,
        ]);
    }
    public function delivered($order){
        $order = $this->orderService->getByStatus($order);
        return redirect()->back();
    }
}

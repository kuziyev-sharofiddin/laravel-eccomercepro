<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use PDF;

class AdminController extends Controller
{
    public function view_category(){
        if(Auth::id())
        {
            $categories = Category::all();
            return view('admin.category')->with([
            'categories' => $categories
            ]);
        }
        else
        {
            return redirect('login');
        }
    }

    public function add_category(Request $request){

        $category = Category::create([
            'category_name' => $request->category_name,
            // 'post_id' => $request->post_id,
            // "user_id" => auth()->id(),
        ]);
        return redirect()->back()->with('message', 'Category Added Successfully');
    }

    public function delete_category(Category $category){
        $category->delete();
        return redirect()->back()->with('message','Category Deleted Successfully');
    }

    public function order(){
        return view('admin.order')->with([
            'orders' => Order::all()
        ]);
    }

    public function delivered(Order $order){
        $order->delivery_status='delivered';
        $order->payment_status='Paid';
        $order->save();
        return redirect()->back();
    }

    public function print_pdf(Order $order){
        $pdf = PDF::loadView('admin.pdf', compact('order'));
        return $pdf->download('order_details.pdf');
    }

    public function search(Request $request){
        $searchText = $request->search;
        // dd($searchText);
        // $order = Order::get('name');
        // dd($order);
        $orders  = Order::where('name', 'LIKE', "%$searchText%")->orWhere('phone', 'LIKE', "%$searchText%")->orWhere('product_title', 'LIKE', "%$searchText%")->get();
        return view('admin.order')->with([
            'orders' => $orders,
        ]);
    }
}

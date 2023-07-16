<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\Comment;
use App\Models\Reply;
use App\Models\Contact;
use Session;
use Stripe;

class HomeController extends Controller
{

    public function index(){
        return view('home.userpage')->with([
            'products'=> Product::paginate(6),
            'comments' => Comment::orderby('id', 'desc')->get(),
            'replies' => Reply::all(),
            'categories' => Category::all()
        ]);
    }


    public function redirect(){
        $usertype = Auth::user()->usertype;

        if ($usertype == '1')
        {
            $total_product = Product::all()->count();
            $total_order = Order::all()->count();
            $total_user = User::all()->count();
            $order = Order::all();
            $total_revenue=0;
            $total_delivered = Order::where('delivery_status', '=', 'delivered')->get()->count();
            $total_processing = Order::where('delivery_status', '=', 'processing')->get()->count();


            foreach($order as $order)
            {
                $total_revenue = $total_revenue + $order->price;
            }
            return view('admin.home')->with([
                'total_product' => $total_product,
                'total_order' => $total_order,
                'total_user' => $total_user,
                'total_revenue' => $total_revenue,
                'total_delivered' => $total_delivered,
                'total_processing' => $total_processing
        ]);
        }

        else
        {

            return view('home.userpage')->with([
                'products'=> Product::paginate(6),
                'comments' => Comment::orderby('id', 'desc')->get(),
                'replies' => Reply::all(),
                'categories' => Category::all()
        ]);
        }
    }

    public function product_details(Product $product){
        return view('home.product_details')->with([
            'product'=> $product,
            'categories' => Category::all()
        ]);
    }

    public function add_cart(Request $request, Product $product, Cart $cart){
        if(Auth::id()){
            $user = Auth::user();
            $product_exist_id = Cart::where('product_id', '=', $product->id)->where('user_id', '=', $user->id)->get('id')->first();
            if($product_exist_id)
            {
                $cart = Cart::find($product_exist_id)->first();
                $quantity = $cart->quantity;
                $cart->quantity = $quantity + $request->quantity;
                if($product->discount_price!=null)
                {
                    $cart->price = $product->discount_price * $cart->quantity;
                }
                else
                {
                    $cart->price = $product->price * $cart->quantity;
                }
                $cart->save();
                Alert::success('Product Added Successfully','We have added product to the cart');

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
                    $cart->price = $product->discount_price * $request->quantity;
                }
                else
                {
                    $cart->price = $product->price * $request->quantity;
                }

                $cart->image = $product->image;
                $cart->product_id = $product->id;
                $cart->quantity = $request->quantity;
                $cart->save();
                Alert::success('Product Added Successfully','We have added product to the cart');




                return redirect()->back();
            }


        }
        else
        {
            return redirect('login');
        }
    }

    public function show_cart(){

        if(Auth::id()){
            $id = Auth::user()->id;
            $carts = Cart::where('user_id', '=', $id)->get();
            return view('home.show_cart')->with([
                'carts'=> $carts,
                'categories' => Category::all(),
            ]);
        }
        else
        {
            return redirect('login');
        }

    }

    public function remove_cart(Cart $cart){
        $cart->delete();
        return redirect()->back();
    }

    public function cash_order(){
        $id = Auth::user()->id;
        $carts = Cart::where('user_id', '=', $id)->get();
        foreach($carts as $cart){
            $order = new order;
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
            $cartd = Cart::find($cart_id);
            $cartd->delete();
        }

        return redirect()->back()->with('message', 'We have Received your Order. We will connect with you soon...');
    }

    public function stripe($totalprice){
        return view('home.stripe')->with(['totalprice'=> $totalprice]);
    }

    public function stripePost(Request $request, $totalprice)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create ([
                "amount" => $totalprice * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Thanks for payment"
        ]);

        $id = Auth::user()->id;
        $carts = Cart::where('user_id', '=', $id)->get();
        foreach($carts as $cart){
            $order = new order;
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
            $order->payment_status = 'Paid';
            $order->delivery_status = 'processing';
            $order->save();

            $cart_id = $cart->id;
            $cartd = Cart::find($cart_id);
            $cartd->delete();
        }

        Session::flash('success', 'Payment successful!');

        return back();
    }

    public function show_order(){
        if(Auth::id())
        {
            $id = Auth::user()->id;
            $orders = Order::where('user_id', '=', $id)->get();
            return view('home.show_order')->with([
                'orders'=> $orders,
                'categories' => Category::all(),
            ]);
        }

        else
        {
            return redirect('login');
        }

    }

    public function cancel_order(Order $order){
        $order->delivery_status='You canceled the order';
        $order->save();
        return redirect()->back();
    }

    public function add_comment(Request $request, Comment $comment){
        if(Auth::id())
        {
            $comment->name = Auth::user()->name;
            $comment->user_id = Auth::user()->id;
            $comment->comment = $request->comment;
            $comment->save();
            return redirect()->back();
        }

        else
        {
            return redirect('login');
        }
    }

    public function add_reply(Request $request, Reply $reply){
        if(Auth::id())
        {
            $reply->name = Auth::user()->name;
            $reply->user_id = Auth::user()->id;
            $reply->comment_id = $request->commentId;
            $reply->reply = $request->reply;
            $reply->save();
            return redirect()->back();
        }

        else
        {
            return redirect('login');
        }
    }

    public function product_search(Request $request){
        $searchText = $request->search;
        $products  = Product::where('title', 'LIKE', "%$searchText%")->orWhere('description', 'LIKE', "%$searchText%")->paginate(10);
        return view('home.userpage')->with([
            'products' => $products,
            'comments' => Comment::orderby('id', 'desc')->get(),
            'replies' => Reply::all(),
            'categories' => Category::all(),
        ]);
    }

    public function products(){
        return view('home.all_product')->with([
            'products' => Product::paginate(6),
            'comments' => Comment::orderby('id', 'desc')->get(),
            'replies' => Reply::all(),
            'categories' => Category::all(),
            'message' => 'Product Added Successfully'
        ]);
    }

    public function search_product(Request $request){
        $searchText = $request->search;
        $products  = Product::where('title', 'LIKE', "%$searchText%")->orWhere('description', 'LIKE', "%$searchText%")->paginate(10);
        return view('home.all_product')->with([
            'products' => $products,
            'comments' => Comment::orderby('id', 'desc')->get(),
            'replies' => Reply::all(),
            'categories' => Category::all(),
        ]);
    }

    public function product_category(Category $category, Request $request){
        $searchText = $request->search;
        $products  = Product::where('title', 'LIKE', "%$searchText%")->orWhere('description', 'LIKE', "%$searchText%");
        return view('home.product_category')->with([
            'products' => $products,
            'comments' => Comment::orderby('id', 'desc')->get(),
            'replies' => Reply::all(),
            'category' => $category,
            'categories' => Category::all(),
        ]);
    }

    public function contact(){

        return view('home.contact')->with([
            'categories' => Category::all(),
        ]);
    }

    public function contact_store(Request $request){
        $contact  = Contact::create([
            "name"=>$request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'description' => $request->description,
        ]);

        return redirect()->back();
    }


}

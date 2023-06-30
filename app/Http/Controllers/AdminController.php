<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class AdminController extends Controller
{
    public function view_category(){
        return view('admin.category')->with([
            'categories' => Category::all()
        ]);
    }

    public function add_category(Request $request){

        $category = Category::create([
            'category_name' => $request->category_name,
            // 'post_id' => $request->post_id,
            // "user_id" => auth()->id(),
        ]);
        return redirect()->back()->with('message', 'Category Added Successfully');
    }

    public function delete_category(Category $categoy){
        $category->delete();
        return redirect()->back();
    }
}

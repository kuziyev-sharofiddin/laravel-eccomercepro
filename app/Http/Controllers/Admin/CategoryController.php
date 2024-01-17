<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Auth;
use App\Service\CategoryService;

class CategoryController extends Controller
{
    public function __construct(protected CategoryService $categoryService)
    {

    }

    public function viewCategory()
    {
        if(Auth::id())
        {
            $categories = $this->categoryService->getByPaginate(10);
            return view('admin.category')->with([
            'categories' => $categories
            ]);
        }
        else
        {
            return redirect('login');
        }
    }

    public function addCategory(CategoryRequest $request){
        $this->categoryService->create($request->all());
        return redirect()->back()->with('message', 'Category Added Successfully');
    }

    public function deleteCategory($category){
        $this->categoryService->destroy($category);
        return redirect()->back()->with('message','Category Deleted Successfully');
    }
}

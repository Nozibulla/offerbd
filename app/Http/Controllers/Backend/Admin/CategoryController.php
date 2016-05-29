<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\AddCategoryRequest;

use App\Http\Controllers\Controller;

use App\Models\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
    	$this->middleware('adminAccess');
    }

    // adding a new category page
    public function addNewCategory()
    {
    	$categorys = Category::get();

    	return view('Backend.Admin.category.add_category',compact('categorys'));
    }

    // adding new category
    public function addNewCategoryProcess(AddCategoryRequest $request)
    {
    	$category = new Category;

        $profile_id = auth()->guard('admin')->user()->profile->id;

    	$category->category_name = $request->category_name;

    	$category->profile_id = $profile_id;

    	$category->save();
    }

    // see the pending category list
    public function pendingCategory()
    {
    	$pending_category = Category::wherestatus(0)->paginate(10);

    	return view('Backend.Admin.category.pending_category',compact('pending_category'));

    }

    // see the approved category list
    public function approvedCategory()
    {
    	$approved_category = Category::wherestatus(1)->paginate(10);

    	return view('Backend.Admin.category.approved_category',compact('approved_category'));

    }

    // approve or delete pending category
    public function approvedPendingCategory(Request $request)
    {
        $category_id = $request->category_id;

        $find_category = Category::findOrFail($category_id);

        $find_category->status = 1;

        $find_category->save();
    }

    public function deletePendingCategory(Request $request)
    {
        $category_id = $request->category_id;

        $find_category = Category::findOrFail($category_id);

        $find_category->delete();
    }

    // showing the category detail
    public function showCategoryDetail(Request $request)
    {
        $category_id = $request->category_id;

        $category_info = Category::findOrFail($category_id);

        return view('Backend.Admin.category.show_category_detail',compact('category_info'));
    }

    // saving category after editing
    public function saveEditedCategory(AddCategoryRequest $request)
    {
        $category_id = $request->category_id;

        $find_category = Category::findOrFail($category_id);

        $find_category->category_name = $request->category_name;

        $find_category->save();
    }

}

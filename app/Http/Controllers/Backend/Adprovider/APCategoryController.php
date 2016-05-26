<?php

namespace App\Http\Controllers\Backend\Adprovider;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\AddCategoryRequest;

use App\Http\Controllers\Controller;

use App\Models\Category;

class APCategoryController extends Controller
{
	public function __construct()
	{
		$this->middleware('adProviderAccess');
	}

	// adding a new category page
	public function addCategory()
	{
		$categorys = Category::get();

		return view('Backend.Adprovider.category.add_category',compact('categorys'));
	}

    // adding new category
	public function addCategoryProcess(AddCategoryRequest $request)
	{
		$category = new Category;

		$profile_id = auth()->guard('adProvider')->user()->profile->id;

		$category->category_name = $request->category_name;

		$category->profile_id = $profile_id;

		$category->save();
	}

    // see the pending category list
	public function pendingCategoryList()
	{
		$profile_id = auth()->guard('adProvider')->user()->profile->id;

		$pending_category = Category::wherestatus(0)->whereprofile_id($profile_id)->paginate(10);

		return view('Backend.Adprovider.category.pending_category',compact('pending_category'));

	}

    // see the approved category list
	public function approvedCategoryList()
	{
		$profile_id = auth()->guard('adProvider')->user()->profile->id;

		$approved_category = Category::wherestatus(1)->whereprofile_id($profile_id)->paginate(10);

		return view('Backend.Adprovider.category.approved_category',compact('approved_category'));

	}

    // showing the category detail
	public function showCategoryDetail(Request $request)
	{
		$category_id = $request->category_id;

		$category_info = Category::findOrFail($category_id);

		return view('Backend.Adprovider.category.show_category_detail',compact('category_info'));
	}

}

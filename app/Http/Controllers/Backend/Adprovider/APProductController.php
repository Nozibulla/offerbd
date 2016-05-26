<?php

namespace App\Http\Controllers\Backend\Adprovider;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\AddProductRequest;

use App\Http\Controllers\Controller;

use App\Models\Category;

use App\Models\Product;

class APProductController extends Controller
{
	public function __construct()
	{
		$this->middleware('adProviderAccess');
	}

    // adding a new product page
	public function addProduct()
	{
		$categorys = Category::pluck('category_name','id');

		return view('Backend.Adprovider.products.add_product',compact('categorys'));
	}

    // adding a new product
	public function addProductProcess(AddProductRequest $request)
	{
		$product = new Product;

		$product->product_name = $request->product_name;

		$product->category_id = $request->category_id;

		$product->profile_id = auth()->guard('adProvider')->user()->id;

		$product->save();

	}

    // pending product list
	public function pendingProductList()
	{
		$profile_id = auth()->guard('adProvider')->user()->profile->id;

		$pending_products = Product::wherestatus(0)->whereprofile_id($profile_id)->paginate(10);

		return view('Backend.Adprovider.products.pending_product',compact('pending_products'));
	}

	// approved product list
	public function approvedProductList()
	{
		$profile_id = auth()->guard('adProvider')->user()->profile->id;

		$approved_products = Product::wherestatus(1)->whereprofile_id($profile_id)->paginate(10);

		return view('Backend.Adprovider.products.approved_product',compact('approved_products'));
	}

	// showing the product detail
	public function showProductDetail(Request $request)
	{
		$product_id = $request->product_id;

		$product_info = Product::findOrFail($product_id);

		return view('Backend.Adprovider.products.show_product_detail',compact('product_info'));
	}
}

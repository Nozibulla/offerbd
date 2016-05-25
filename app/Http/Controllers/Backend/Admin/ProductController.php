<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\AddProductRequest;

use App\Http\Controllers\Controller;

use App\Models\Category;

use App\Models\Product;

class ProductController extends Controller
{
    public function __construct()
    {
    	$this->middleware('adminAccess');
    }

    // adding a new product page
    public function addNewProduct()
    {
    	$categorys = Category::pluck('category_name','id');

    	return view('Backend.Admin.products.add_product',compact('categorys'));
    }

    // adding a new product
    public function addNewProductProcess(AddProductRequest $request)
    {
    	$product = new Product;

    	$product->product_name = $request->product_name;

    	$product->category_id = $request->category_id;

    	$product->profile_id = auth()->guard('admin')->user()->id;

    	$product->save();

    }

    // pending product list
    public function pendingProduct()
	{
		$pending_products = Product::wherestatus(0)->get();

		return view('Backend.Admin.products.pending_product',compact('pending_products'));
	}

	// approved product list
	public function approvedProduct()
	{
		$approved_products = Product::wherestatus(1)->get();

		return view('Backend.Admin.products.approved_product',compact('approved_products'));
	}

	// approve or delete pending product
    public function approvedPendingProduct(Request $request)
    {
        $product_id = $request->product_id;

        $find_product = Product::findOrFail($product_id);

        $find_product->status = 1;

        $find_product->save();
    }

    public function deletePendingProduct(Request $request)
    {
        $product_id = $request->product_id;

        $find_product = Product::findOrFail($product_id);

        $find_product->delete();
    }

    // showing the product detail
    public function showProductDetail(Request $request)
    {
        $product_id = $request->product_id;

        $product_info = Product::findOrFail($product_id);

        return view('Backend.Admin.products.show_product_detail',compact('product_info'));
    }

    // saving category after editing
    public function saveEditedProduct(AddProductRequest $request)
    {
        $product_id = $request->product_id;

        $find_product = Product::findOrFail($product_id);

        $find_product->product_name = $request->product_name;

        $find_product->save();
    }

}

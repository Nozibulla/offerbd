<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell the application the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
| All rights reserved 
|
| Copyright     : http://www.offerbd.com
| Developed By  : ENABLE IT BANGLADESH
| Maintained By : ENABLE IT BANGLADESH
| 
|
*/

/**
 * route group for admin (owner)
 */

Route::group(['middleware' => 'admin'], function () {

	//creating a pattern for id (integer type)
	Route::pattern('id', '[0-9]+');
	Route::pattern('admin_id', '[0-9]+');
	Route::pattern('brand_id', '[0-9]+');
	Route::pattern('profile_id', '[0-9]+');
	Route::pattern('branch_id', '[0-9]+');
	Route::pattern('category_id', '[0-9]+');
	Route::pattern('advertisement_id', '[0-9]+');

	//login options
	Route::get('/admin/login','Backend\Admin\AuthController@getLogin');
	Route::post('/admin/login','Backend\Admin\AuthController@postLogin');
	Route::get('/admin/under-review','Backend\Admin\AuthController@underReview');

	//registration options
	Route::get('/admin/registration','Backend\Admin\AuthController@getRegister');
	Route::post('/admin/registration','Backend\Admin\AuthController@postRegister');

	//logout options
	Route::get('/admin/logout','Backend\Admin\AuthController@getLogout');

	// dashboard options
	Route::get('/admin/dashboard','Backend\Admin\DashboardController@showDashboard');

	//admin profile options
	Route::get('/admin/profile','Backend\Admin\ProfileController@showProfile');

	//updating info
	Route::post('/saveprofileinfo','Backend\Admin\ProfileController@updateProfileInfo');

	// admin menu items (only accessed by "owner")
	Route::get('/admin/approved-admin','Backend\Admin\AdminController@approvedAdminList');
	Route::get('/admin/pending-admin','Backend\Admin\AdminController@pendingAdminList');
	Route::get('/admin/rolewise-admin','Backend\Admin\AdminController@rolewiseAdminList');
	Route::get('/admin/admin-list/details/{admin_id}','Backend\Admin\AdminController@showSingleAdmin');

	// approving an admin from the pending admin list page
	Route::post('/approveadmin', 'Backend\Admin\AdminController@approveAdmin');
	
	// removing an admin
	Route::post('/removeadmin', 'Backend\Admin\AdminController@deleteAdmin');
	
	// changing the admin privilege
	Route::post('/changeprivilege', 'Backend\Admin\AdminController@changeAdminPrivilege');	
	
	//brands options
	Route::get('/admin/brands/add-brand', 'Backend\Admin\BrandController@addBrand');
	Route::post('/addnewbrand','Backend\Admin\BrandController@addBrandProcess');
	Route::get('/admin/brands/pending-brand', 'Backend\Admin\BrandController@pendingBrandList');
	Route::get('/admin/brands/approved-brand', 'Backend\Admin\BrandController@approvedBrandList');

	// Approve/Remove brand directly
	Route::post('/approvebrand', 'Backend\Admin\BrandController@approvedPendingBrand');
	Route::post('/removebrand', 'Backend\Admin\BrandController@deletePendingBrand');

	// edit a brand
	Route::get('/admin/brands/details/{brand_id}', 'Backend\Admin\BrandController@showBrandDetail');

	// save brand after editing
	Route::post('/saveeditedbrand','Backend\Admin\BrandController@saveEditedBrand');

	// showing the member detail page of a specific brand
	Route::get('/profile/members/{profile_id}','Backend\Admin\ProfileController@showMemberProfile');

	// branch options
	Route::get('/admin/branch/add-branch', 'Backend\Admin\BranchController@addNewBranch');
	Route::post('/addnewbranch', 'Backend\Admin\BranchController@addNewBranchProcess');
	Route::get('/admin/branch/pending-branch', 'Backend\Admin\BranchController@pendingBranchList');
	Route::get('/admin/branch/approved-branch', 'Backend\Admin\BranchController@approvedBranchList');

	// Approve/Remove branch directly
	Route::post('/approvebranch', 'Backend\Admin\BranchController@approvedPendingBranch');
	Route::post('/removebranch', 'Backend\Admin\BranchController@deletePendingBranch');

	// edit a branch
	Route::get('/admin/branch/details/{branch_id}', 'Backend\Admin\BranchController@showBranchDetail');

	// save branch after editing
	Route::post('/saveeditedbranch','Backend\Admin\BranchController@saveEditedBranch');

	// category options
	Route::get('/admin/category/add-category', 'Backend\Admin\CategoryController@addNewCategory');
	Route::post('/addnewcategory', 'Backend\Admin\CategoryController@addNewCategoryProcess');
	Route::get('/admin/category/pending-category', 'Backend\Admin\CategoryController@pendingCategory');
	Route::get('/admin/category/approved-category', 'Backend\Admin\CategoryController@approvedCategory');

	// Approve/Remove category directly
	Route::post('/approvecategory', 'Backend\Admin\CategoryController@approvedPendingCategory');
	Route::post('/removecategory', 'Backend\Admin\CategoryController@deletePendingCategory');

	// edit a category
	Route::get('/admin/category/details/{category_id}', 'Backend\Admin\CategoryController@showCategoryDetail');

	// save category after editing
	Route::post('/saveeditedcategory','Backend\Admin\CategoryController@saveEditedCategory');

	// products routes
	Route::get('/admin/products/add-product', 'Backend\Admin\ProductController@addNewProduct');
	Route::post('/addnewproduct', 'Backend\Admin\ProductController@addNewProductProcess');
	Route::get('/admin/products/pending-product', 'Backend\Admin\ProductController@pendingProduct');
	Route::get('/admin/products/approved-product', 'Backend\Admin\ProductController@approvedProduct');
	// Approve/Remove product directly
	Route::post('/approveproduct', 'Backend\Admin\ProductController@approvedPendingProduct');
	Route::post('/removeproduct', 'Backend\Admin\ProductController@deletePendingProduct');
	// edit a category
	Route::get('/admin/products/details/{product_id}', 'Backend\Admin\ProductController@showProductDetail');
	// save product after editing
	Route::post('/saveeditedproduct','Backend\Admin\ProductController@saveEditedProduct');

	// advertisement portions
	Route::get('/admin/advertisements/post-ad','Backend\Admin\AdvertisementController@addAdvertisement');
	Route::post('/addnewadvertisement','Backend\Admin\AdvertisementController@addAdvertisementProcess');
	Route::get('/admin/advertisements/pending-ad','Backend\Admin\AdvertisementController@pendingAdvertisement');
	Route::get('/admin/advertisements/approved-ad','Backend\Admin\AdvertisementController@approvedAdvertisement');
	// Approve/Remove advertisement directly
	Route::post('/approveadvertisement','Backend\Admin\AdvertisementController@approvedPendingAdvertisement');
	Route::post('/removeadvertisement','Backend\Admin\AdvertisementController@deletePendingAdvertisement');
	// edit an advertisement
	Route::get('/admin/advertisements/details/{advertisement_id}', 'Backend\Admin\AdvertisementController@showAdvertisementDetail');
	// save advertisement after editing
	Route::post('/saveeditedadvertisement','Backend\Admin\AdvertisementController@saveEditedAdvertisement');

	// subscriptions list
	Route::get('/admin/subscriptions/list', 'Backend\Admin\SubscriptionController@subscriptionList');
});


/**
 * route group for user(advertisement provider)
 */
Route::group(['middleware' => 'adProvider'], function () {

	Route::get('/adprovider/login','Backend\adprovider\AuthController@getLogin');
	Route::post('/adprovider/login','Backend\adprovider\AuthController@postLogin');
	Route::get('/adprovider/registration','Backend\adprovider\AuthController@getRegister');
	Route::post('/adprovider/registration','Backend\adprovider\AuthController@postRegister');
	Route::get('/adprovider/logout','Backend\adprovider\AuthController@getLogout');

	Route::get('/adprovider/dashboard','Backend\Adprovider\DashboardController@showDashboard');

	Route::get('/adprovider/profile', 'Backend\Adprovider\ProfileController@showProfile');

	//updating info
	Route::post('/SAdPI','Backend\Adprovider\ProfileController@updateProfileInfo');

	// brands options
	Route::get('/adprovider/brands/add-brand', 'Backend\Adprovider\APBrandController@addBrand');
	Route::post('/adprovider/addnewbrand', 'Backend\Adprovider\APBrandController@addBrandProcess');
	Route::get('/adprovider/brands/pending-brand', 'Backend\Adprovider\APBrandController@pendingBrandList');
	Route::get('/adprovider/brands/approved-brand', 'Backend\Adprovider\APBrandController@approvedBrandList');

});


Route::group(['middleware' => 'web'], function () {

	Route::get('/','Frontend\DashboardController@index');

});
<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use App\Models\Subscription;

class SubscriptionController extends Controller
{
    function __construct()
    {
    	$this->middleware('adminAccess');
    }

    // showing the subscription list
    public function subscriptionList()
    {
    	$subscription_list = Subscription::paginate(20);

    	return view('Backend.Admin.subscriptions.subscriptions_list',compact('subscription_list'));
    }
}

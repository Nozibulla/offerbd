<?php

namespace App\Http\Controllers\Backend\Adprovider;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\AddBranchRequest;

use App\Http\Controllers\Controller;

use App\Models\Brand;

use App\Models\Branch;

class APBranchController extends Controller
{
    public function __construct()
    {
    	$this->middleware('adProviderAccess');
    }

    // showing the new branch addition page
    public function addNewBranch(Request $request)
    {

        $brands = Brand::pluck('brand_name','id');

    	return view('Backend.Adprovider.branches.add_branch',compact('brands'));
    }

    // processing the branch addition
    public function addNewBranchProcess(AddBranchRequest $request)
    {
    	$branch = new Branch;

    	$profile_id = auth()->guard('adProvider')->user()->profile->id;

    	$branch->branch_name = $request->branch_name;
    	
    	$branch->brand_id = $request->brand_id;

    	$branch->profile_id =  $profile_id;

    	$branch->save();

    }

    public function pendingBranchList()
	{
		$profile_id = auth()->guard('adProvider')->user()->profile->id;

		$pending_branchs = Branch::wherestatus(0)->whereprofile_id($profile_id)->get();

		return view('Backend.Adprovider.branches.pending_branch',compact('pending_branchs'));
	}

    public function approvedBranchList()
	{
		$profile_id = auth()->guard('adProvider')->user()->profile->id;

		$approved_branchs = Branch::wherestatus(1)->whereprofile_id($profile_id)->get();

		return view('Backend.Adprovider.branches.approved_branch',compact('approved_branchs'));
	}

	public function showBranchDetail(Request $request)
	{
		$branch_info = Branch::findOrFail($request->branch_id);

		return view('Backend.Adprovider.branches.show_branch_detail',compact('branch_info'));
	}

	
}

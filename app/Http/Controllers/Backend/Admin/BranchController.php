<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\AddBranchRequest;

use App\Http\Controllers\Controller;

use App\Models\Brand;

use App\Models\Branch;

class BranchController extends Controller
{
    public function __construct()
    {
    	$this->middleware('adminAccess');
    }

    // showing the new branch addition page
    public function addNewBranch(Request $request)
    {

        $brands = Brand::pluck('brand_name','id');

    	return view('Backend.Admin.branches.add_branch',compact('brands'));
    }

    // processing the branch addition
    public function addNewBranchProcess(AddBranchRequest $request)
    {
    	$branch = new Branch;

    	$profile_id = auth()->guard('admin')->user()->profile->id; 

    	$branch->branch_name = $request->branch_name;
    	
    	$branch->brand_id = $request->brand_id;

    	$branch->profile_id = $profile_id;

    	$branch->save();

    }

    public function pendingBranchList()
	{
		$pending_branchs = Branch::wherestatus(0)->get();

		return view('Backend.Admin.branches.pending_branch',compact('pending_branchs'));
	}

	public function approvedBranchList()
	{
		$approved_branchs = Branch::wherestatus(1)->get();

		return view('Backend.Admin.branches.approved_branch',compact('approved_branchs'));
	}

	public function approvedPendingBranch(Request $request)
	{
		$branch_id = $request->branch_id;

		$find_branch = Branch::findOrFail($branch_id);

		$find_branch->status = 1;

		$find_branch->save();

	}

	public function deletePendingBranch(Request $request)
	{
		$branch_id = $request->branch_id;

		$find_branch = Branch::findOrFail($branch_id);

		$find_branch->delete();

	}

	public function showBranchDetail(Request $request)
	{
		$branch_info = Branch::findOrFail($request->branch_id);

		return view('Backend.Admin.branches.show_branch_detail',compact('branch_info'));
	}

	// save branch after editing
	public function saveEditedBranch(AddBranchRequest $request)
	{
		$branch_id = $request->branch_id;

		$find_branch = Branch::findOrFail($branch_id);

        $find_branch->branch_name = $request->branch_name;

		// $find_branch->brand_id = $find_branch->brand_id;

		$find_branch->save();
	}

}

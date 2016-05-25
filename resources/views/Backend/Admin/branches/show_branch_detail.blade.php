@extends('Backend.Admin.layouts.master')

@section('sidebar')

@include ('Backend.Admin.layouts.sidebar')

@endsection

@section('content')

<div id="page-wrapper" class="branch_detail">

	<div class="branch_detail_div">

		<div class="row">

			<div class="col-lg-12">

				<h1 class="page-header">

					Branch Name : {{ $branch_info->branch_name }}

					<small>{{ ($branch_info->status == 0)? "Pending" : "Approved" }}</small>
					
				</h1>

			</div>

			<!-- /.col-lg-12 -->

		</div>
		<!-- /.row -->

		<div class="row">

			<div class="col-md-6">Branch Name: {{ $branch_info->branch_name }}</div>

			<div class="col-md-6">

				@define $branch_owner = $branch_info->profile
				
				<strong>Branch Owner</strong>

				<div class="owner_name">Owner Name: 
					{{ $branch_owner->first_name." ".$branch_owner->last_name }}
				</div>

				<div class="owner_mobile">Owner Mobile:
					{{ $branch_owner->mobile }}
				</div>

				<div class="owner_address">Owner Address:
					
					<address>
						{{ $branch_owner->address }}
					</address>

				</div>

			</div>

		</div>

		<div class="row branch_option">

			<div class="col-md-12">

				<div class="pull-left branch_edit_delete">

					@if ($branch_info->status == 0)

					<input type="button" class="btn btn-default approve_branch" name="approve_branch" value="Approve Branch" data-toggle="modal" data-target="#approveBranchModal">
					@include ('Backend.modals.approve_branch_modal')

					@endif

					<input type="button" class="btn btn-default delete_approved_branch" name="remove_branch" value="Delete Branch" data-toggle="modal" data-target="#removeBranchModal">
					@include ('Backend.modals.remove_branch_modal')

					<input type="button" class="btn btn-default" name="edit_branch" value="Edit Branch" data-toggle="modal" data-target="#editBranchModal">
					@include ('Backend.modals.edit_branch_modal')

				</div>
				
			</div>

		</div>

	</div>

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

@endsection

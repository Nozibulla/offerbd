@extends('Backend.Admin.layouts.master')

@section('title')

<title>Dashboard | offerbd</title>

@stop 

@section('sidebar')

@include ('Backend.Admin.layouts.sidebar')

@endsection

@section('content')

<div id="page-wrapper">

    @define $admin_profile = auth()->guard('admin')->user()->profile

    <!-- checking the admin has set the profile info -->
    @if(empty($admin_profile->first_name) || empty($admin_profile->last_name))

    @include('Backend.modals.set_profile_warning')

    @endif
    <!-- end of admin profile info checking -->

    <div class="row">

        <div class="col-lg-12">

            <h1 class="page-header">Dashboard</h1>

        </div>

        <!-- /.col-lg-12 -->

    </div>

    <!-- /.row -->

    Roles are: 

    @foreach (auth()->guard('admin')->user()->role as $role)

    {{ $role->role_name }}/

    @endforeach

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

@endsection

@extends('Backend.Admin.layouts.master') 

@section('sidebar')

@include ('Backend.Admin.layouts.sidebar')

@endsection

@section('content')

<div id="page-wrapper">

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

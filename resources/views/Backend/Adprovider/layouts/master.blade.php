<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="offerbd">

    <meta name="author" content="enableit">

    <meta name="csrf-token" content="{!! csrf_token() !!}">

    @yield('title')

    @yield('sectionJS')

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-2.2.3.min.js" integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js" integrity="sha256-xNjb53/rY+WmG+4L6tTl9m6PpqknWZvRt0rO1SRnJzw=" crossorigin="anonymous"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('shared/js/bootstrap.min.js') }}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{ asset('backend/adprovider/js/metisMenu.min.js') }}"></script>

    <!-- inline editing -->
    <script src="{{ asset('shared/inline-edit/js/bootstrap-editable.js') }}" type="text/javascript"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{ asset('backend/adprovider/js/custom.js') }}"></script>

    <script src="{{ asset('backend/adprovider/js/offerbd.custom.js') }}"></script>

    @yield('sectionCSS')

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('shared/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{ asset('backend/admin/css/metisMenu.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('backend/admin/css/sb-admin-2.css') }}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('shared/inline-edit/css/bootstrap-editable.css') }}">

    <link href="{{ asset('backend/admin/css/offerBD.custom.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ asset('font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>

        <div id="wrapper">
            <!-- finding the logged in adprovider profile -->
            @define $adprovider_profile = auth()->guard('adProvider')->user()->profile

            <!-- checking the admin has set the profile info -->
            @if((empty($adprovider_profile->first_name) || empty($adprovider_profile->last_name)) && (Request::path() != 'adprovider/profile/show' && Request::path() != 'adprovider/profile/setting'))

            @include('Backend.modals.set_adprovider_profile_warning')

            @endif
            <!-- end of admin profile info checking -->
            
            <!-- adding flash message -->
            @include('Shared._partials.flash')
            <!-- end of flash message -->

            <!-- showing the ajax loader -->
            <div class="overlay" style="display: none">
                <img src="{{ asset('images/offerbd.gif') }}" class="img-responsive" alt="offerbd loader">
            </div>
            <!-- end of ajax loader -->

            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">

                <div class="navbar-header">

                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">

                        <span class="sr-only">Toggle navigation</span>

                        <span class="icon-bar"></span>

                        <span class="icon-bar"></span>

                        <span class="icon-bar"></span>

                    </button>

                    <a class="navbar-brand" href="{{ url('/adprovider/dashboard') }}">
                        <!-- set Mr X as default name if no name is found -->
                        {{ ($adprovider_profile->first_name && $adprovider_profile->last_name) ? $adprovider_profile->first_name." ". $adprovider_profile->last_name : "Mr. X" }} | offerBD
                        <!-- default name set complete -->
                    </a>

                </div>
                <!-- /.navbar-header -->

                <ul class="nav navbar-top-links navbar-right">

                    <li class="dropdown">

                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">

                            <i class="fa fa-envelope fa-fw"></i>  

                            <i class="fa fa-caret-down"></i>

                        </a>

                        <ul class="dropdown-menu dropdown-messages">

                            <li>

                                <a href="{{ url('#') }}">

                                    <div>

                                        <strong>John Smith</strong>

                                        <span class="pull-right text-muted">

                                            <em>Yesterday</em>

                                        </span>

                                    </div>

                                    <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>

                                </a>

                            </li>

                            <li class="divider"></li>

                        </ul>
                        <!-- /.dropdown-messages -->

                    </li>
                    <!-- /.dropdown -->

                    <li class="dropdown">

                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">

                            <i class="fa fa-tasks fa-fw"></i> 

                            <i class="fa fa-caret-down"></i>

                        </a>

                        <ul class="dropdown-menu dropdown-tasks">

                            <li>

                                <a href="{{ url('#') }}">

                                    <div>

                                        <p>

                                            <strong>Task 1</strong>

                                            <span class="pull-right text-muted">40% Complete</span>

                                        </p>

                                        <div class="progress progress-striped active">

                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">

                                                <span class="sr-only">40% Complete (success)</span>

                                            </div>

                                        </div>

                                    </div>

                                </a>

                            </li>

                            <li class="divider"></li>

                            <li>

                                <a class="text-center" href="{{ url('#') }}">

                                    <strong>See All Tasks</strong>

                                    <i class="fa fa-angle-right"></i>

                                </a>

                            </li>

                        </ul>
                        <!-- /.dropdown-tasks -->

                    </li>
                    <!-- /.dropdown -->

                    <li class="dropdown">

                        <a class="dropdown-toggle" data-toggle="dropdown" href="{{ url('#') }}">

                            <i class="fa fa-bell fa-fw"></i>

                            <i class="fa fa-caret-down"></i>

                        </a>

                        <ul class="dropdown-menu dropdown-alerts">

                            <li>

                                <a href="{{ url('#') }}">

                                    <div>

                                        <i class="fa fa-comment fa-fw"></i>

                                        New Comment

                                        <span class="pull-right text-muted small">4 minutes ago</span>

                                    </div>

                                </a>

                            </li>

                            <li class="divider"></li>

                            <li>

                                <a class="text-center" href="{{ url('#') }}">

                                    <strong>See All Alerts</strong>

                                    <i class="fa fa-angle-right"></i>

                                </a>

                            </li>

                        </ul>

                        <!-- /.dropdown-alerts -->

                    </li>

                    <!-- /.dropdown -->

                    <li class="dropdown">

                        <a class="dropdown-toggle" data-toggle="dropdown" href="{{ url('#') }}">

                            <i class="fa fa-user fa-fw"></i>  

                            <i class="fa fa-caret-down"></i>

                        </a>
                        
                        <ul class="dropdown-menu dropdown-user">

                            <li>

                                <a> 

                                    {{ Auth::guard('adProvider')->user()->email }}

                                </a>

                            </li>

                            <li>

                                <a href="{{ url('/adprovider/profile/show') }}">

                                    <i class="fa fa-user fa-fw"></i> 

                                    User Profile

                                </a>

                            </li>

                            <li>

                                <a href="{{ url('/adprovider/profile/setting') }}">

                                    <i class="fa fa-gear fa-fw"></i> 

                                    Settings

                                </a>

                            </li>

                            <li class="divider"></li>
                            
                            <li>

                                <a href="{{ url('/adprovider/logout') }}">

                                    <i class="fa fa-sign-out fa-fw"></i> 

                                    Logout

                                </a>

                            </li>

                        </ul>
                        <!-- /.dropdown-user -->

                    </li>
                    <!-- /.dropdown -->

                </ul>
                <!-- /.navbar-top-links -->

                @yield('sidebar')

                @yield('content')

            </body>

            </html>

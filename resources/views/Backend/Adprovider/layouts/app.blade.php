<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{!! csrf_token() !!}">

    @yield('title')

    <!-- js -->

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-2.2.3.min.js" integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js" integrity="sha256-xNjb53/rY+WmG+4L6tTl9m6PpqknWZvRt0rO1SRnJzw=" crossorigin="anonymous"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('shared/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('backend/adprovider/js/offerbd.login.js') }}"></script>

    <!-- Custom Fonts -->
    <link href="{{ asset('font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- CSS -->

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('shared/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- customize css file for login/registration -->

    <link rel="stylesheet" href="{{ asset('backend/adprovider/css/login/reset.css') }}" type="text/css">

    <link rel="stylesheet" href="{{ asset('backend/adprovider/css/login/animate.css') }}" type="text/css">

    <link rel="stylesheet" href="{{ asset('backend/adprovider/css/login/styles.css') }}" type="text/css">

    <link rel="stylesheet" href="{{ asset('backend/adprovider/css/login/offerbd.custom.login.css') }}" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        

    </head>

    <body id="app-layout">

        <!-- adding flash message -->
        @include('Shared._partials.flash')
        <!-- end of flash message -->

        <!-- setting the overlay for loading image -->
        <div class="overlay" style="display: none">
           <img src="{{ asset('images/offerbd.gif') }}" class="img-responsive" alt="offerbd loader">
       </div>
       <!-- end of loaded -->

       <nav class="navbar navbar-default navbar-static-top">

        <div class="container">

            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">

                    <span class="sr-only">Toggle Navigation</span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>

                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">OfferBD</a>

            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">

                <!-- Right Side Of Navbar -->

                <ul class="nav navbar-nav navbar-right">

                    <!-- Authentication Links -->

                    @if (Auth::guard('adProvider')->guest())

                    <li>

                        <a href="{{ url('/adprovider/login') }}">Sign In</a>
                        
                    </li>

                    <li>

                        <a href="{{ url('/adprovider/registration') }}">Sign Up</a>

                    </li>

                    @else

                    <li class="dropdown">

                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">

                            {{ auth()->guard('adProvider')->user()->email }} 

                            <span class="caret"></span>

                        </a>

                        <ul class="dropdown-menu" role="menu">

                            <li>

                                <a href="{{ url('/adprovider/logout') }}">

                                    <i class="fa fa-btn fa-sign-out"></i>

                                    Logout

                                </a>

                            </li>

                        </ul>

                    </li>

                    @endif

                </ul>

            </div>

        </div>

    </nav>

    @yield('content')

</body>

</html>

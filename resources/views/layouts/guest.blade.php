<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">


        <title>{{ config('app.name', 'DeGuide') }}</title>

        <!-- Fonts -->
        <!-- <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet"> -->

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/font-awesome.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}" >

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
    </head>
    <body>
                <!-- ***** Preloader Start ***** -->
        <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
            <span></span>
            <span></span>
            <span></span>
            </div>
        </div>
        </div>
        <!-- ***** Preloader End ***** -->

        <header class="header-area header-sticky" style="background-color:#F8F8F8;">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav class="main-nav">
                            <a href="{{url('/')}}" class="logo" style="color:black; font-size: 32px; font-weight: 800;">De<em>Guide</em></a>
                            <ul class="nav">
                                @if(request()->routeIs('home'))
                                <li><a href="{{url('/')}}" class="active" >Home</a></li>
                                @else
                                <li><a href="{{url('/')}}"  style="color:black;">Home</a></li>
                                @endif
                                @if(request()->routeIs('blog'))
                                <li><a href="{{url('/blog')}}" class="active" >Blog</a></li>
                                @else
                                <li><a href="{{url('/blog')}}" style="color:black;" >Blog</a></li>
                                @endif

                            </ul>        
                            <a class='menu-trigger'>
                                <span>Menu</span>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
        <br><br>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>

        <!-- <footer > -->
            <div class="container " style=" bottom:0; padding: 30px 0px;font-size: 13px;text-align:center">
                <div class="row">
                    <div class="col-lg-12">
                        <p style="color: #232d39;">
                            Copyright © {{date('Y')}} DeGuide - All Rights Reserved.
                        </p>
                    </div>
                </div>
            </div>
        <!-- </footer> -->
        
        <script src="{{asset('js/jquery-2.1.0.min.js')}}"></script>
        <script src="{{asset('js/popper.js')}}"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
        <script src="{{asset('js/scrollreveal.min.js')}}"></script>
        <script src="{{asset('js/waypoints.min.js')}}"></script>
        <script src="{{asset('js/jquery.counterup.min.js')}}"></script>
        <script src="{{asset('js/imgfix.min.js')}}"></script> 
        <script src="{{asset('js/mixitup.js')}}"></script> 
        <script src="{{asset('js/accordions.js')}}"></script>

        <script src="{{asset('js/custom.js')}}"></script>
    </body>
</html>

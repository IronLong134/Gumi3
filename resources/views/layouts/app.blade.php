<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/autoload.js') }}" defer></script>
    <script src="{{ asset('js/sendmsg.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- ************8-->
    {{--
    <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css"> --}}

    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <!-- ************8-->

    <!-- ************8-->
    <!-- icon -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf"
          crossorigin="anonymous">


    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>

    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <!-- new -->


</head>

<body>
<div id="app">
    <input type="hidden" name="csrf-token" content="{{ csrf_token() }}">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                </ul>
            </div>
        </div>
    </nav>
    @endif @else
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
               data-toggle="dropdown" aria-haspopup="true"
               aria-expanded="false" v-pre>
                {{ Auth::user()->name }} <span class="caret"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                      style="display: none;">
                    @csrf
                </form>
            </div>
        </li>

        </ul>
</div>
</div>
</nav>
<div>
    <section class="content-header">


        <div class="container">

            <nav class="navbar navbar-expand-lg navbar-light bg-primary ">
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarTogglerDemo03"
                        aria-controls="navbarTogglerDemo03"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand text-white" href="\home"><i
                        class="far fa-newspaper"></i> Bảng tin
                </a>


                <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                        <li class="nav-item active">
                            <a class="nav-link text-white"
                               href="/profile_post/{{Auth::user()->id}}"><img
                                    class=" avatar1"
                                    src="{{ url('/') }}/imgs/@if(Auth::user()->avatar){{Auth::user()->avatar}}@elseif(!Auth::user()->avatar && Auth::user()->gender==1){{"avatar_male.jpg"}}@else{{"avatar_female.jpg"}}@endif"
                                    alt=""> {{Auth::user()->name}} <span
                                    class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white"
                               href="/rq_friends/{{Auth::user()->id}}"><i
                                    class="fas fa-envelope-open-text"></i>Lời mời kết
                                bạn<span class="badge badge-danger"><r id="countrq">{{count($request)}}</r></span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white"
                               href="/list_friends/{{Auth::user()->id}}"><i
                                    class="fas fa-user-friends"></i>Bạn bè(<f id="countfri">{{count($count_friends)}}</f>)</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="/all_people"><i
                                    class="fas fa-users"></i>Mọi người</a>
                        </li>
                    </ul>
                    <form class="form-inline my-2 my-lg-0">
                        {{csrf_field()}}
                        <input class="form-control mr-sm-2" id="myInput" type="search" placeholder="Search"
                               aria-label="Search" required>
                        <button class="btn btn-info my-2 my-sm-0" type="submit" >Search
                        </button>
                    </form>
                </div>
            </nav>
        </div>

    </section>
</div>


@endguest


</div>
</body>
<main class="py-4">
    @yield('content')
</main>
</html>

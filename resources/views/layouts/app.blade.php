<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>



    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>PotSpot</title>

    <!-- Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://kit.fontawesome.com/4c344606d6.js" crossorigin="anonymous"></script>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<style>

</style>
<body class="background" style="background-attachment:fixed">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm fixed-top">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img heigth="30"width=250 src="">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fa-regular fa-user"></i>{{ Auth::user()->name }}
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a
                                onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();"><i class="fa-solid fa-right-from-bracket"></i>Logout
                             </a>
                             <form id="logout-form" action="{{ route('logout') }}"  method="POST">
                                 @csrf
                             </form>
                            </li>



                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                    </li>
                                </div>

                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm fixed-bottom" style="height: 60px">
            @if(App\Http\Controllers\userController::agenda())
                <li class="nav-item"style="list-style: none; margin-left:60px;">
                    <a href="/agendaIndex" style="color:white"><i style="colorwhite" class="fa-solid fa-calendar-days fa-2xl"></i></a>
                </li>
                <li class="nav-item"style="list-style: none; margin-right:0px;">
                    <a href="/" style="color:white"><i style="color:white" class="fa-solid fa-house fa-2xl"></i></a>
                </li>
                <li class="nav-item"style="list-style: none; margin-right:60px;">
                    <a href="/user/show/{{ Auth::id() }}" style="color:white"><i style="color:white" class="fa-solid fa-user fa-2xl"></i></a>
                </li>
            @endif
        </nav>
            <main class="py-4" >
            @yield('content')
        </main>
    </div>
</body>
</html>

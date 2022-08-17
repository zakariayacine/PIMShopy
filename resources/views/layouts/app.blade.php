<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://kit.fontawesome.com/11eef5aa61.js" crossorigin="anonymous"></script>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        .hidden {
            display: none !important;
        }
    
        .activated {
            display: block;
        }
    </style>
    <!-- Font Awesome -->
<link
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
rel="stylesheet"
/>
<!-- Google Fonts -->
<link
href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
rel="stylesheet"
/>
<!-- MDB -->
<link
href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.4.0/mdb.min.css"
rel="stylesheet"
/>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            @guest
            @else
            <a onclick="hidnav()" class="btn" style="margin-left: 20px !important"><i class="fa-solid fa-bars"></i></a>
            @endguest
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
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
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @guest
                @yield('content')
            @else
            <div class="row container-fluid">
                <div class="col-md-2 " id="nav">
                    <ul class="list-group list-group-light ">
                        <li class="list-group-item"><div class="d-grid gap-2"><a class="btn btn-link" href="{{route('images')}}">Bibliothèque d'image</a></div></li>
                        <li class="list-group-item"><div class="d-grid gap-2"><a class="btn btn-link" href="#">Liste des produits</a></li>
                        <li class="list-group-item"><div class="d-grid gap-2"><a class="btn btn-link" href="{{route('import')}}"><i class="fa-solid fa-file-excel  fa-xl"> </i> Importer des produits</a></div></li>
                        <li class="list-group-item"><div class="d-grid gap-2"><a class="btn btn-link" href="{{route('import')}}"><i class="fa-solid fa-file-excel fa-xl"> </i> Exporter des produits</a></div></li>
                        <li class="list-group-item"><div class="d-grid gap-2"><a class="btn btn-link" href="{{route('import')}}"><i class="fa-solid fa-file-csv fa-xl"> </i> Exporter des produits</a></div></li>
                    </ul>
                </div>
                <div id="warper" class="col-md-10">
                @yield('content')
                </div>
                @endguest
            </div>
            
            
        </main>
    </div>
    <script>
        function hidnav(){
            if(document.getElementById('nav').className === "hidden"){
                document.getElementById('nav').className = "activated col-md-2";
                document.getElementById('warper').className = "col-md-10";

            }else{
                document.getElementById('nav').className = "hidden";
                document.getElementById('warper').className = "col-md-12";
            }
            
            
        }
    </script>
</body>
</html>

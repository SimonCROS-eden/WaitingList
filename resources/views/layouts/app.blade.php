<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @auth
        <meta name="id" content="{{ Auth::user()->id }}">
        <meta name="admin" content="{{ Auth::user()->admin }}">
    @endauth

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="//{{ Request::getHost() }}:6001/socket.io/socket.io.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app" class="d-flex flex-column">
        @include('partials.navbar')

<<<<<<< HEAD
        <main class="flex-fill d-flex py-4">
=======
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
                            @endif
                        @else
                            <li>
                                <a href="{{ route('ticket.create') }}">Create</a>
                            </li>
                            <li>
                                <a href="{{ route('tag.index') }}">Tag</a>
                            </li>
                            @if (Auth::user()->isAdmin())
                                <li>
                                    <a href="{{ route('tag.index') }}">Tag</a>
                                </li>
                            @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->fullName()}} 
                                    <span>{{ Auth::user()->scoreHelp }}</span> 
                                    @if (Auth::user()->isAdmin())
                                        <span>{{ Auth::user()->nbAsk }}</span> 
                                    @endif
                                    <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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
>>>>>>> afaa43842e51f47f3d5e85fbf396a9148c50505d
            @auth
                <ul class="list-group w-25">
                    @foreach ($users as $user)
                        <li class="list-group-item">
                            <user name="{{ $user->fullName() }}" score="{{ $user->scoreHelp }}" ask="{{ $user->nbAsk }}" admin="{{ Auth::user()->isAdmin() }}"></user>
                        </li>
                    @endforeach
                </ul>
            @endauth
            @yield('content')
        </main>
    </div>
</body>
</html>

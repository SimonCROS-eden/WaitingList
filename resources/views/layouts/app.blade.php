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
        <main class="flex-fill d-flex py-4">
            @auth
                <ul class="list-group w-25 d-none d-md-block">
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

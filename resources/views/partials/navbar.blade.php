<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <header class="d-flex align-items-center">
            <a class="navbar-brand mr-4" href="{{ url('/') }}">
                <img src="/images/icon.svg" width="30" height="30" class="d-inline-block align-top" alt="">
            </a>
            @auth
                <user :user="{{ json_encode(Auth::user()->serialize(Auth::user()->isAdmin())) }}"></user>
            @endauth
        </header>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
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
                    @endif
                @else
                    <li>
                        <a class="btn btn-primary" href="/ticket/create">Créer un ticket</a>
                    </li>
                    @if (Auth::user()->isAdmin())
                        <li>
                            <a class="ml-2 btn btn-primary" href="{{ route('tag.index') }}">Tags</a>
                        </li>
                    @endif
                    <li>
                        <a class="ml-2 btn btn-primary" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
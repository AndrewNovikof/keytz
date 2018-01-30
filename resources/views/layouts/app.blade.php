<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app" class="uk-offcanvas-content">
    <div class="tm-page">
        <div class="uk-navbar-container tm-header uk-sticky uk-sticky-fixed uk-sticky-below" uk-navbar>
            <div class="uk-container uk-width-2-3">
                <nav class="uk-navbar">
                    <div class="uk-navbar-left">
                        <ul class="uk-navbar-nav">
                            <li class="uk-active"><a href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a></li>
                        </ul>
                    </div>
                    <div class="uk-navbar-right">

                        <ul class="uk-navbar-nav">
                            @guest
                                <li><a href="{{ route('login') }}">Login</a></li>
                                <li><a href="{{ route('register') }}">Register</a></li>
                            @else
                                <li>
                                    <router-link to="/books">
                                        <i class="fa fa-window-restore"></i> <span
                                                class="nav-label">Книги</span>
                                    </router-link>
                                </li>
                                <li>
                                    <router-link to="/catalogs">
                                        <i class="fa fa-window-restore"></i> <span
                                                class="nav-label">Списки</span>
                                    </router-link>
                                </li>
                                <li class="dropdown">
                                    <router-link  to="/" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                       aria-expanded="false"
                                       aria-haspopup="true">
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </router-link>
                                    <div class="uk-navbar-dropdown">
                                        <ul class="uk-nav uk-navbar-dropdown-nav">
                                            <li>
                                                <a href="{{ route('logout') }}"
                                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                    Logout
                                                </a>

                                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                      style="display: none;">
                                                    {{ csrf_field() }}
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </nav>
            </div>
        </div>

        @yield('content')

    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

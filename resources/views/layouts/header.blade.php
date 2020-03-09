<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @if (auth()->check())
        <meta name="api-token" content="{{ $user->api_token }}">
        @endif

        @yield('meta')

        <title>YourDesignContest - @yield('title')</title>

        <script defer src="{{ mix('/js/app.js') }}"></script>

        @stack('scripts')

        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
        <script src="https://kit.fontawesome.com/207a639368.js" crossorigin="anonymous"></script>
        @stack('stylesheets')

        @yield('styles')

        <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
        <link href="https://fonts.googleapis.com/css?family=Calistoga|Lato:400,700&display=swap" rel="stylesheet">

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        @if ($production)
            <!-- Global site tag (gtag.js) - Google Analytics -->
            <script async src="https://www.googletagmanager.com/gtag/js?id=UA-67055393-6"></script>
            <script>
                window.dataLayer = window.dataLayer || [];
                function gtag(){dataLayer.push(arguments);}
                gtag('js', new Date());

                gtag('config', 'UA-67055393-6');
            </script>
        @endif
    </head>
    <body>
        <div id="app" class="d-flex flex-column">
            <nav class="navbar navbar-expand-md navbar-dark bg-dark">
                <div class="container">
                    <button class="navbar-toggler ml-auto"
                            type="button"
                            data-toggle="collapse"
                            data-target="#navbarTogglerDemo01"
                            aria-controls="navbarText"
                            aria-expanded="false"
                            aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">
                                    Home <span class="sr-only">(current)</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('contests.index') }}">Contests</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('contact.form') }}">Contact</a>
                            </li>
                        </ul>

                        <ul class="navbar-nav">
                            @auth
                                <li class="nav-item">
                                    <span class="nav-link">
                                        <notifications :initial-notifications='@json($user->notifications)'></notifications>
                                    </span>
                                </li>

                                <li class="nav-item">
                                    <dropdown>
                                        <template v-slot:header>{{ $user->name }}</template>

                                        <template v-slot:menu>
                                            <a class="nav-link pl-3 pr-3" href="{{ route('users.show', $user) }}">Profile</a>
                                            <a class="nav-link pl-3 pr-3" href="{{ route('users.edit', $user) }}">Settings</a>
                                            <a class="nav-link pl-3 pr-3" href="{{ route('logout') }}">Log out</a>
                                        </template>
                                    </dropdown>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link d-inline-block" href="{{ route('register') }}">Register</a>
                                    <a class="nav-link d-inline-block" href="{{ route('login') }}">Login</a>
                                </li>
                            @endauth
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="branding">
                <div class="container">
                    <h1 class="mb-3 mb-sm-5 logo">
                        YourDesignContest<span class="period">.</span>
                    </h1>
                </div>
            </div>

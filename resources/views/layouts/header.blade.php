<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="Description" content="Get quality design ideas from an ocean of designers for your next graphic design project.">

        @if (auth()->check())
        <meta name="api-token" content="{{ $user->api_token }}">
        @endif

        @yield('meta')

        <title>YourDesignContest - @yield('title')</title>

        <script defer src="{{ mix('js/app.js') }}"></script>

        @stack('scripts')

        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <script src="https://kit.fontawesome.com/207a639368.js" crossorigin="anonymous"></script>

        @stack('stylesheets')

        @yield('styles')

        <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
        <link href="https://fonts.googleapis.com/css?family=Calistoga|Lato:400,700&display=swap" rel="stylesheet">

        @if ($production)
            <!-- Global site tag (gtag.js) - Google Analytics -->
            <script async src="https://www.googletagmanager.com/gtag/js?id=UA-67055393-6"></script>
            <script>
                window.dataLayer = window.dataLayer || [];
                function gtag(){dataLayer.push(arguments);}
                gtag('js', new Date());

                gtag('config', 'UA-67055393-6');
            </script>

            <!-- Hotjar Tracking Code for https://yourdesigncontest.com/ -->
            <script>
                (function(h,o,t,j,a,r){
                    h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
                    h._hjSettings={hjid:2282841,hjsv:6};
                    a=o.getElementsByTagName('head')[0];
                    r=o.createElement('script');r.async=1;
                    r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
                    a.appendChild(r);
                })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
            </script>
        @endif

        {{-- Ziggy named routes for frontend usage --}}
        @routes
    </head>
    <body>
        <div id="app" class="d-flex flex-column">
            <nav class="navbar navbar-expand-md @yield('nav-classes')">
                <div class="container">
                    @include('layouts.navigation')
                </div>
            </nav>

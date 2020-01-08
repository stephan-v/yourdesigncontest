<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>YourDesignContest</title>

        <script defer src="{{ mix('/js/app.js') }}"></script>

        @stack('scripts')

        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        @stack('stylesheets')

        @yield('styles')

        <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
        <link href="https://fonts.googleapis.com/css?family=Calistoga|Muli:400,900&display=swap" rel="stylesheet">

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-67055393-6"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-67055393-6');
        </script>
    </head>
    <body>
        <div id="app">

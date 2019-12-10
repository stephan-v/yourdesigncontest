<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>YourDesignContest</title>

        <script defer src="{{ mix('/js/app.js') }}"></script>

        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">

        <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
        <link href="https://fonts.googleapis.com/css?family=Calistoga|Roboto&display=swap" rel="stylesheet">

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
        <div id="app" class="h-100 d-flex align-items-center">

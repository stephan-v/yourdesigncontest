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
            <div class="container">
                <div class="center d-flex">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="p-3 p-sm-5">
                                <h1 class="mb-3 mb-sm-5">YourDesignContest<span class="orange">.</span></h1>
                                <p>We love putting designers and clients in touch with each other.</p>
                                <p>Join us and become part the next wave of independent designers and freelancers.</p>
                                <p>Or host a graphic design contest and attract the best designers in our community.</p>
                            </div><!-- /.p-5 -->
                        </div><!-- /.col-md-6 -->

                        <div class="col-md-6 position-relative">
                            <div class="image-placeholder">
                                <signup></signup>
                                <div class="image"></div>
                            </div><!-- /.image-placeholder -->
                        </div><!-- /.col-md-6 -->
                    </div><!-- /.row -->
                </div><!-- /.modal -->
            </div><!-- /.container -->
        </div><!-- /#app -->
    </body>
</html>

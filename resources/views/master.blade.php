<!DOCTYPE html>
<html lang="{{ Illuminate\Support\Facades\App::getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('master.title')</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="apple-touch-icon" sizes="57x57" href="{{ favicon_img_asset('apple-icon-57x57') }}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{ favicon_img_asset('apple-icon-60x60') }}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ favicon_img_asset('apple-icon-72x72') }}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ favicon_img_asset('apple-icon-76x76') }}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ favicon_img_asset('apple-icon-114x114') }}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ favicon_img_asset('apple-icon-120x120') }}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{ favicon_img_asset('apple-icon-144x144') }}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ favicon_img_asset('apple-icon-152x152') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ favicon_img_asset('apple-icon-180x180') }}">
        <link rel="icon" type="image/png" sizes="192x192" href="{{ favicon_img_asset('android-icon-192x192') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ favicon_img_asset('favicon-32x32') }}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{ favicon_img_asset('favicon-96x96') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ favicon_img_asset('favicon-16x16') }}">
        <link rel="manifest" href="{{ favicon_file_asset('manifest') }}">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">

        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500" rel="stylesheet"/>
        <link href="https://cdn.materialdesignicons.com/3.0.39/css/materialdesignicons.min.css" rel="stylesheet" />

        @stack('master.style')
        <link rel="stylesheet" href="{{ css_asset('sleek') }}" type="text/css">
        <link rel="stylesheet" href="{{ css_asset('master') }}" type="text/css">

        <!--HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries-->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script src="{{ js_asset('nprogress') }}" type="application/javascript"></script>
    </head>

    <body class="bg-theme-dark" id="body">
        @yield('master.body')
        @stack('master.script')
        <script src="{{ js_asset('master') }}" type="application/javascript"></script>
    </body>
</html>

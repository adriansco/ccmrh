<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="EASuarez">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('img/logo-fav.png') }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/perfect-scrollbar/css/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('lib/material-design-icons/css/material-design-iconic-font.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/line-awesome/css/line-awesome.min.css') }}" />
    @yield('csszone')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" type="text/css" />

</head>

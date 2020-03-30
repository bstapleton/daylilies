<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-36420374-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-36420374-1');
    </script>
    <meta charset="utf-8">
    <title>Order form - A La Carte Daylilies</title>
    <meta name="theme-color" content="#006600">
    <link href="{{ asset('css/print.css') }}" rel="stylesheet" media="all">
</head>
<body class="l-orderForm">
@section('content')
    @yield('content')
@show
</body>
</html>

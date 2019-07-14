<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>A La Carte Daylilies - Order form</title>
    <meta name="theme-color" content="#006600">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="{{ asset('css/print.css') }}" rel="stylesheet" media="print">
</head>
<body class="l-orderForm">
@section('content')
    @yield('content')
@show
</body>
</html>

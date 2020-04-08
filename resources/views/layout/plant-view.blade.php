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
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @isset ($title)
        <title>{{ $title }} - A La Carte Daylilies</title>
    @else
        <title>A La Carte Daylilies</title>
    @endisset

    @isset ($metaDescription)
        <meta name="description" content="{{ $metaDescription }}">
    @endisset
    <meta name="theme-color" content="#006600">
    @env('production')
        <link href="{{ asset('css/dist/app.css') }}" rel="stylesheet">
    @else
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @endenv
</head>
<body class="l-body">
    <div class="h-flex h-flex--column">
        @section('layout-header')
            <div class="l-plant-view-header">
                <h1 class="l-plant-view-header__title h-heading">A La Carte Daylilies</h1>
            </div>
        @show

        <div class="h-flex h-flex-wrap" itemscope itemtype="https://schema.org/Product">
            <link itemprop="additionalType" href="http://www.productontology.org/id/Plant" />
            <div class="l-plant-view-content">
                @section('content')
                    @yield('content')
                @show
            </div>

            <div class="l-plant-view-sidebar">
                @section('sidebar')
                    @yield('sidebar')
                @show
            </div>
        </div>

        @section('layout-footer')
            <div class="l-plant-view-footer">
                @include('partials.site-footer-content')
            </div>
        @show
    </div>
</body>
</html>

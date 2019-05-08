<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>A La Carte Daylilies{{$title != null ? ' - ' . $title : null}}</title>

    <link href="https://fonts.googleapis.com/css?family=Great+Vibes|Open+Sans" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="l-body">
    @section('layout-header')
        <div class="l-site-header">
            <h1 class="l-site-header__title h-heading">A La Carte Daylilies</h1>
        </div>
    @show

    <div class="h-flex">
        <div class="l-sidebar-navigation">
            <ul class="l-sidebar-navigation__list h-list--unstyled">
                <li class="l-sidebar-navigation__item">
                    <a href="#" class="l-sidebar-navigation__link">Home</a>
                </li>
                <li class="l-sidebar-navigation__item">
                    <a href="#" class="l-sidebar-navigation__link">New plants</a>
                </li>
                <li class="l-sidebar-navigation__item">
                    <a href="#" class="l-sidebar-navigation__link">Large flowered</a>
                </li>
                <li class="l-sidebar-navigation__item">
                    <a href="#" class="l-sidebar-navigation__link">Small flowered</a>
                </li>
                <li class="l-sidebar-navigation__item">
                    <a href="#" class="l-sidebar-navigation__link">Miniatures</a>
                </li>
                <li class="l-sidebar-navigation__item">
                    <a href="#" class="l-sidebar-navigation__link">Spider daylilies</a>
                </li>
                <li class="l-sidebar-navigation__item">
                    <a href="#" class="l-sidebar-navigation__link">Order form</a>
                </li>
                <li class="l-sidebar-navigation__item">
                    <a href="#" class="l-sidebar-navigation__link">Contact us</a>
                </li>
            </ul>
        </div>

        <div class="l-page-content">
            @section('content')
                @yield('content')
            @show
        </div>
    </div>

    @section('layout-footer')
        <div class="l-site-footer">
            default footer here
        </div>
    @show
</body>
</html>

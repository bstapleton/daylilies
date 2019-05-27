<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @isset ($title)
        <title>A La Carte Daylilies - {{ $title }}</title>
    @else
        <title>A La Carte Daylilies</title>
    @endisset

    @isset ($metaDescription)
        <meta name="description" content="{{ $metaDescription }}">
    @endisset
    <meta name="theme-color" content="#006600">
    <link href="https://fonts.googleapis.com/css?family=Great+Vibes|Open+Sans" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="l-body">
    @section('layout-header')
        <div class="l-site-header">
            <h1 class="l-site-header__title h-heading">A La Carte Daylilies</h1>
            <form action="post" role="search" class="l-site-header__form h-flex h-flex--align-center">
                <label for="search" class="c-label">Search</label>
                <input type="search" name="search" id="search" class="l-site-header__field c-field h-margin-left__default">
                <input type="submit" class="c-button c-button--default h-margin-left__default">
            </form>
        </div>
    @show

    <div class="h-flex">
        <div class="l-sidebar-navigation">
            <ul class="l-sidebar-navigation__list h-list--unstyled">
                <li class="l-sidebar-navigation__item">
                    <a href="#" class="l-sidebar-navigation__link" title="A La Carte Daylilies homepage">Home</a>
                </li>
                <li class="l-sidebar-navigation__item">
                    <a href="#" class="l-sidebar-navigation__link" title="New Daylilies for {{Date('Y')}} and {{Date('Y') - 1}}">New plants</a>
                </li>
                <li class="l-sidebar-navigation__item">
                    <a href="#" class="l-sidebar-navigation__link" title="Large flowered daylilies">Large flowered</a>
                </li>
                <li class="l-sidebar-navigation__item">
                    <a href="#" class="l-sidebar-navigation__link" title="Small flowered daylilies">Small flowered</a>
                </li>
                <li class="l-sidebar-navigation__item">
                    <a href="#" class="l-sidebar-navigation__link" title="Miniature flowered daylilies">Miniatures</a>
                </li>
                <li class="l-sidebar-navigation__item">
                    <a href="#" class="l-sidebar-navigation__link" title="Spider flowered and unusual form daylilies">Spider daylilies</a>
                </li>
                <li class="l-sidebar-navigation__item">
                    <a href="#" class="l-sidebar-navigation__link" title="Online daylily order form">Order form</a>
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

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
        <title>A La Carte Daylilies - {{ $title }}</title>
    @else
        <title>A La Carte Daylilies</title>
    @endisset

    @isset ($metaDescription)
        <meta name="description" content="{{ $metaDescription }}">
    @endisset
    <meta name="theme-color" content="#006600">
    <link href="https://fonts.googleapis.com/css?family=Great+Vibes|Open+Sans" rel="stylesheet">
    @env('production')
        <link href="{{ asset('css/dist/app.css') }}" rel="stylesheet">
    @else
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @endenv
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
</head>
<body class="l-body h-flex h-flex--column">
    @section('layout-header')
        <div class="l-site-header">
            <h1 class="l-site-header__title h-heading">A La Carte Daylilies</h1>
            <form action="post" role="search" class="l-site-header__form h-flex h-flex--align-center">
                <label for="search" class="c-label">Search</label>
                <input type="search" name="search" id="search" class="l-site-header__field c-field h-margin-left__default">
                <input type="submit" class="c-button--default h-margin-left__default">
            </form>
            <ul class="h-list--unstyled h-no-padding c-search-list" id="search-list" style="display: none;"></ul>
        </div>
    @show

    <div class="h-flex h-flex--grow">
        <div class="l-sidebar-navigation">
            <ul class="l-sidebar-navigation__list h-list--unstyled h-no-margin h-no-padding">
                <li class="l-sidebar-navigation__item">
                    <a href="{{ URL::route('home') }}" class="l-sidebar-navigation__link" title="A La Carte Daylilies homepage">Home</a>
                </li>
                <li class="l-sidebar-navigation__item">
                    <a href="{{ URL::route('plants.new') }}" class="l-sidebar-navigation__link" title="New Daylilies for {{Date('Y')}} and {{Date('Y') - 1}}">New plants</a>
                </li>
                <li class="l-sidebar-navigation__item">
                    <a href="{{ URL::route('plants.category', 'large') }}" class="l-sidebar-navigation__link" title="Large flowered daylilies">Large flowered</a>
                </li>
                <li class="l-sidebar-navigation__item">
                    <a href="{{ URL::route('plants.category', 'small') }}" class="l-sidebar-navigation__link" title="Small flowered daylilies">Small flowered</a>
                </li>
                <li class="l-sidebar-navigation__item">
                    <a href="{{ URL::route('plants.category', 'miniature') }}" class="l-sidebar-navigation__link" title="Miniature flowered daylilies">Miniatures</a>
                </li>
                <li class="l-sidebar-navigation__item">
                    <a href="{{ URL::route('plants.category', 'spider') }}" class="l-sidebar-navigation__link" title="Spider flowered and unusual form daylilies">Spider daylilies</a>
                </li>
                <li class="l-sidebar-navigation__item">
                    <a href="{{ URL::route('order-form') }}" class="l-sidebar-navigation__link" title="Online daylily order form">Order form</a>
                </li>
                <li class="l-sidebar-navigation__item">
                    <a href="{{ URL::route('contact-us') }}" class="l-sidebar-navigation__link">Contact us</a>
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
            @include('partials.site-footer-content')
        </div>
    @show

    <script type="text/javascript">
        $('#search').on('focus', function() {
            if (this.value.length > 0) {
                this.value = '';
            }
        });

        $('#search').on('keyup', function() {
            $value = $(this).val();
            $.ajax({
                type : 'get',
                url : '{{ URL::to('search') }}',
                data:{'search':$value},
                success:function(data){
                    $('#search-list').show().html(data);
                }
            });
        });

        $('#search').on('blur', function() {
            setTimeout(function() {
                $('#search-list').css('display', 'none');
            }, 100)
        });

        $('a').click(function(event) {
            if ($(this).attr('disabled')) {
                event.preventDefault();
            }
        });

        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
    </script>
</body>
</html>

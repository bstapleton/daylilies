@extends('layout.default')

@section('layout-header')
    @parent
@endsection

@section('content')
    @include('partials.covid-19')
    <h1 class="h-heading l-page-content__title">Welcome</h1>
    <div class="c-card c-card--light">
        <p>Welcome to our website devoted entirely to DAYLILIES (Hemerocallis), an enchanting perennial, easy to grow, and in so many colours, shapes, sizes and forms. We have divided our daylilies into four main categories; Large flowered, Small flowered, Miniature and Spider types. We also have a small selection of micro-propagated daylilies.</p>
        <p>A La Carte Daylilies is a mail order service. Daylilies are ideal subjects for mail order because they are so resilient. We have often had plants sent to us from abroad that have been in transit for 3 or 4 weeks (or more) but very soon regained their vigour. We send them to you by first class post and they nearly always arrive within two days.</p>
    </div>

    <h2 class="h-subheading">News</h2>
    <div class="c-card c-card--light">
        <p>This year is our 25th year of A La Carte Daylilies. We took the Daylilies to Hampton Court Flower Show three times and the people loved the Daylilies.</p>
        <p>Over the years we have collected many Daylilies and we have selected many more so do enjoy looking at our website. </p>
        <p>We would also like to thank our many customers for their lovely letters. Enjoy your Daylilies from Jan and Andy.</p>
    </div>

    <div class="c-card">
        <figure class="c-lightbox h-flex h-flex--column">
            <img itemprop="image" src="{{ asset('images/garden02.jpg') }}" alt="Photo from the A La Carte Daylilies garden" class="c-lightbox__image" />
        </figure>
    </div>

    <div class="c-card c-card--light">
        <p>Most of our plants were originally imported and before they could be considered for inclusion in this web site they have been planted out and trialled in our garden for 4 to 5 years. We need to do this because some imports do not perform well in our climate and these will not be offered for sale.</p>
    </div>

    <div class="c-card c-card--dark">
        <p>We hold two National Collections of Hemerocallis; Miniature (Jan) and Large flowered (post 1960 award winners) (Andy). The status of National Collection is given by the National Council for Conservation of Plants and Gardens.</p>
    </div>
@endsection

@section('layout-footer')
    @parent
@endsection

@extends('layout.default')

@section('layout-header')
    @parent
@endsection

@section('content')
    <h1 class="h-heading l-page-content__title">{{ $categoryTitle }}</h1>
    @isset($category)
        @if ($category == 'large')
            @include('partials/introduction_large')
        @endif
    @endisset
    <div class="c-plant-grid h-flex h-flex-wrap">
        @foreach($plants as $plant)
            <article class="h-list--unstyled c-plant-grid__item h-flex h-flex--column" itemscope itemtype="http://schema.org/Product">
                <link itemprop="additionalType" href="http://www.productontology.org/id/Plant" />
                <div class="c-plant-grid__thumbnail">
                    <a href="{{ URL::route('plants.view', $plant->slug) }}" title="View details for {{ $plant->name }}"><img class="c-plant-grid__image" itemprop="image" loading="lazy" src="{{ asset('images/thumbnails/' . $plant->slug . '.jpg') }}" alt="" /></a>
                </div>
                <div class="c-plant-grid__detail">
                    <h2 itemprop="name" class="c-plant-grid__title h-no-margin h-no-padding">
                        <a href="{{ URL::route('plants.view', $plant->slug) }}" class="c-plant-grid__link" title="View details for {{ $plant->name }}">{{ $plant->name }}</a>
                    </h2>
                    <meta itemprop="sku" content="{{ $plant->category->name }}{{ $plant->id }}">
                    <meta itemprop="mpn" content="{{ $plant->category->name }}{{ $plant->id }}">
                    <p class="c-plant-grid__stock" itemprop="offers" itemscope itemtype="http://schema.org/Offer" itemid="#offer">
                        <meta itemprop="url" content="http://alacartedaylilies.co.uk/large/airs_and_graces.jpg">
                        <meta itemprop="priceCurrency" content="GBP">&pound;<span itemprop="price">{{ $plant->price }}</span> /
                        @if ($plant->in_stock == true)
                            <link itemprop="availability" href="http://schema.org/InStock" />In stock
                        @else
                            <link itemprop="availability" href="http://schema.org/OutOfStock" />Out of stock
                        @endif
                    </p>
                </div>
            </article>
        @endforeach
    </div>

    @if ($plants instanceof \Illuminate\Pagination\LengthAwarePaginator)
        {{ $plants->links() }}
    @endif
@endsection

@section('layout-footer')
    @parent
@endsection

@extends('layout.default')

@section('layout-header')
    @parent
@endsection

@section('content')
    @include('partials.covid-19')
    @include('partials.plants-introduction')
    <div class="c-plant-grid h-flex h-flex-wrap" itemscope itemtype="https://schema.org/ItemList">
        @foreach($plants as $key => $plant)
            <article class="h-list--unstyled c-plant-grid__item h-flex h-flex--column" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <meta itemprop="position" content="{{ $key + 1 }}">
                <link itemprop="additionalType" href="http://www.productontology.org/id/Plant" />
                <div class="c-plant-grid__thumbnail">
                    <a href="{{ URL::route('plants.view', $plant->slug) }}" title="View details for {{ $plant->name }}"><img class="c-plant-grid__image" itemprop="image" loading="lazy" src="{{ $plant->thumbnail }}" alt="{{ $plant->name }}" /></a>
                </div>
                <div class="c-plant-grid__detail">
                    <h2 itemprop="name" class="c-plant-grid__title h-no-margin h-no-padding">
                        <a href="{{ URL::route('plants.view', $plant->slug) }}" class="c-plant-grid__link" title="View details for {{ $plant->name }}">{{ $plant->name }}</a>
                    </h2>
                    <meta itemprop="url" itemscope content="{{ URL::route('plants.view', $plant->slug) }}">
                    <p class="c-plant-grid__stock">
                        &pound;<span>{{ $plant->price }}</span> /
                        {{ $plant->in_stock ? 'In' : 'Out of' }} stock
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

@extends('layout.plant-view')

@section('layout-header')
    @parent
@endsection

@section('content')
    <figure class="c-lightbox h-flex h-flex--column">
        <img itemprop="image" itemscope src="{{ asset('images/plants/' . $plant->slug . '.jpg') }}" alt="Hemerocallis {{ $plant->name }} in full bloom." class="c-lightbox__image" />
        <figcaption class="c-lightbox__caption"><i>Hemerocallis</i> '{{ $plant->name }}'</figcaption>
    </figure>
@endsection

@section('sidebar')
    <h1 itemprop="name" class="l-plant-view-sidebar__title">{{ $plant->name }}</h1>
    <meta itemprop="sku" content="{{ $plant->category->name }}{{ $plant->id }}">
    <meta itemprop="mpn" content="{{ $plant->category->name }}{{ $plant->id }}">
    <p itemprop="description">{{ $plant->description }}</p>
    <div itemprop="brand" itemtype="https://schema.org/Brand" itemscope>
        <meta itemprop="name" content="A La Carte Daylilies" />
    </div>
    <h2>Details</h2>
    <ul class="c-key-value-list h-list--unstyled h-no-padding">
        <li class="h-flex c-key-value-list__item" itemprop="additionalProperty" itemscope itemtype="https://schema.org/PropertyValue">
            <span class="c-key-value-list__key" itemprop="name">Category</span>
            <a href="{{ URL::route('plants.category', strtolower($plant->category->name)) }}" class="c-key-value-list__value h-anchor--branded" itemprop="value">{{ $plant->category->name }} flowered</a>
        </li>

        <li class="h-flex c-key-value-list__item" itemprop="additionalProperty" itemscope itemtype="https://schema.org/PropertyValue">
            <span class="c-key-value-list__key" itemprop="name">Registered</span>
            @if ($plant->year_hybridised == 0)
                <span class="c-key-value-list__value" itemprop="value"><em>Unknown</em></span>
            @else
                <span class="c-key-value-list__value" itemprop="value">{{ $plant->year_hybridised }}</span>
            @endif
        </li>
        <li class="h-flex c-key-value-list__item" itemprop="additionalProperty" itemscope itemtype="https://schema.org/PropertyValue">
            <span class="c-key-value-list__key" itemprop="name">Ploidy</span>
            <span class="c-key-value-list__value" itemprop="value">{{ $plant->genome->name }}</span>
        </li>
        <li class="h-flex c-key-value-list__item" itemprop="additionalProperty" itemscope itemtype="https://schema.org/PropertyValue">
            <span class="c-key-value-list__key" itemprop="name">Height</span>
            <span class="c-key-value-list__value">
                <span itemprop="value">{{ $plant->height }}</span><meta itemprop="unitCode" content="inches">"
                (<span itemprop="value">{{ $plant->heightInCm }}</span><meta itemprop="unitCode" content="centimetres">cm)
            </span>
        </li>
        <li class="h-flex c-key-value-list__item" itemprop="additionalProperty" itemscope itemtype="https://schema.org/PropertyValue">
            <span class="c-key-value-list__key" itemprop="name">Flower size</span>
            <span class="c-key-value-list__value">
                <span itemprop="value">{{ $plant->flower_size }}</span><meta itemprop="unitCode" content="inches">"
                (<span itemprop="value">{{ $plant->flowerInCm }}</span><meta itemprop="unitCode" content="centimetres">cm)
            </span>
        </li>
        <li class="h-flex c-key-value-list__item" itemprop="additionalProperty" itemscope itemtype="https://schema.org/PropertyValue">
            <span class="c-key-value-list__key">Hybridiser</span>
            @if(count($plant->hybridisers) == 0)
                <span class="c-key-value-list__value" itemprop="value"><em>Unregistered</em></span>
            @endif
            @foreach ($plant->hybridisers as $hybridiser)
                @if ($loop->count == 1)
                    <a href="{{ URL::route('hybridiser', $hybridiser->slug) }}" class="c-key-value-list__value h-anchor--branded" itemprop="additionalProperty" itemscope itemtype="https://schema.org/PropertyValue">
                        <meta itemprop="name" content="Hybridiser">
                        <span itemprop="value" title="View all daylilies hybridised by {{ $hybridiser->full_name }}">{{ $hybridiser->full_name }}</span>
                    </a>
                @else
                    @if ($loop->iteration == 1)
                    <span class="c-key-value-list__value" itemprop="additionalProperty" itemscope itemtype="https://schema.org/PropertyValue">
                    @endif
                        <meta itemprop="name" content="Hybridiser">
                        <a itemprop="value" href="{{ URL::route('hybridiser', $hybridiser->slug) }}" class="h-anchor--branded" title="View all daylilies hybridised by {{ $hybridiser->full_name }}">{{ $hybridiser->full_name }}</a>{{ $loop->remaining > 0 ? ', ' : null }}
                    @if ($loop->remaining == 0)
                    </span>
                    @endif
                @endif
            @endforeach
        </li>
        <li class="h-flex c-key-value-list__item" itemprop="additionalProperty" itemscope itemtype="https://schema.org/PropertyValue">
            <span class="c-key-value-list__key" itemprop="name">Foliage type</span>
            <a href="{{ URL::route('plants.foliage', strtolower($plant->foliage->name)) }}" class="c-key-value-list__value h-anchor--branded" itemprop="value">{{ $plant->foliage->name }}</a>
        </li>
        <li class="h-flex c-key-value-list__item" itemprop="additionalProperty" itemscope itemtype="https://schema.org/PropertyValue">
            <span class="c-key-value-list__key" itemprop="name">Bloom time</span>
            @foreach ($plant->seasons as $season)
                @if ($loop->count == 1)
                    <a href="{{ URL::route('plants.season', strtolower(str_replace(' ', '-', $season->name))) }}" class="c-key-value-list__value h-anchor--branded" itemprop="value" title="View all daylilies that bloom {{ $season->name }}">{{ $season->name }}</a>
                @else
                    @if ($loop->iteration == 1)
                    <span class="c-key-value-list__value" itemprop="value">
                    @endif
                        <a class="h-anchor--branded" href="{{ URL::route('plants.season', strtolower(str_replace(' ', '-', $season->name))) }}" title="View all daylilies that bloom {{ $season->name }}">{{ $season->name }}</a>{{ $loop->remaining > 0 ? ', ' : null }}
                    @if ($loop->remaining == 0)
                    </span>
                    @endif
                @endif
            @endforeach
        </li>
    </ul>
    <h2>Availability</h2>
    <ul class="c-key-value-list h-list--unstyled h-no-padding" itemprop="offers" itemtype="https://schema.org/Offer" itemscope>
        <li class="h-flex c-key-value-list__item">
            <span class="c-key-value-list__key">Price</span>
            <span class="c-key-value-list__value">
                <meta itemprop="priceCurrency" content="GBP">&pound;<span itemprop="price">{{ $plant->price }}</span>
            </span>
        </li>
        <li class="h-flex c-key-value-list__item">
            <span class="c-key-value-list__key">In stock?</span>
            <span class="c-key-value-list__value">
                @if ($plant->in_stock == true)
                    <link itemprop="availability" href="https://schema.org/InStock" />Yes
                @else
                    <link itemprop="availability" href="https://schema.org/OutOfStock" />No
                @endif
                <meta itemprop="url" itemscope content="{{ URL::route('plants.view', $plant->slug) }}">
            </span>
        </li>
    </ul>
    <a href="{{ request()->headers->get('referer') }}" class="c-button c-button--default">Back</a>
@endsection

@section('layout-footer')
    @parent
@endsection

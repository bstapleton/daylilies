@extends('layout.plant-view')

@section('layout-header')
    @parent
@endsection

@section('content')
    <figure class="c-lightbox h-flex h-flex--column">
        <img itemprop="image" src="{{ asset('images/plants/' . $plant->slug . '.jpg') }}" alt="Hemerocallis {{ $plant->name }} in full bloom." class="c-lightbox__image" />
        <figcaption class="c-lightbox__caption"><i>Hemerocallis</i> '{{ $plant->name }}'</figcaption>
    </figure>
@endsection

@section('sidebar')
    <h1 itemprop="name" class="l-plant-view-sidebar__title">{{ $plant->name }}</h1>
    <meta itemprop="sku" content="{{ $plant->category->name }}{{ $plant->id }}">
    <meta itemprop="mpn" content="{{ $plant->category->name }}{{ $plant->id }}">
    <p itemprop="description">{{ $plant->description }}</p>
    <h2>Details:</h2>
    <ul class="c-key-value-list h-list--unstyled h-no-padding">
        <li class="h-flex c-key-value-list__item" itemprop="additionalProperty" itemscope itemtype="http://schema.org/PropertyValue">
            <span class="c-key-value-list__key" itemprop="name">Category</span>
            <a href="{{ URL::route('plants.category', strtolower($plant->category->name)) }}" class="c-key-value-list__value h-anchor--branded" itemprop="value">{{ $plant->category->name }} flowered</a>
        </li>

        <li class="h-flex c-key-value-list__item" itemprop="additionalProperty" itemscope itemtype="http://schema.org/PropertyValue">
            <span class="c-key-value-list__key" itemprop="name">Registered</span>
            @if ($plant->year_bred == 0)
                <span class="c-key-value-list__value" itemprop="value"><em>Unknown</em></span>
            @else
                <span class="c-key-value-list__value" itemprop="value">{{ $plant->year_bred }}</span>
            @endif
        </li>
        <li class="h-flex c-key-value-list__item" itemprop="additionalProperty" itemscope itemtype="http://schema.org/PropertyValue">
            <span class="c-key-value-list__key" itemprop="name">Ploidy</span>
            <span class="c-key-value-list__value" itemprop="value">{{ $plant->genome->name }}</span>
        </li>
        <li class="h-flex c-key-value-list__item" itemprop="additionalProperty" itemscope itemtype="http://schema.org/PropertyValue">
            <span class="c-key-value-list__key" itemprop="name">Height</span>
            <span class="c-key-value-list__value">
                <span itemprop="value">{{ $plant->height }}</span><meta itemprop="unitCode" content="inches">"
                (<span itemprop="value">{{ $plant->heightInCm }}</span><meta itemprop="unitCode" content="centimetres">cm)
            </span>
        </li>
        <li class="h-flex c-key-value-list__item" itemprop="additionalProperty" itemscope itemtype="http://schema.org/PropertyValue">
            <span class="c-key-value-list__key" itemprop="name">Flower size</span>
            <span class="c-key-value-list__value">
                <span itemprop="value">{{ $plant->flower_size }}</span><meta itemprop="unitCode" content="inches">"
                (<span itemprop="value">{{ $plant->flowerInCm }}</span><meta itemprop="unitCode" content="centimetres">cm)
            </span>
        </li>
        <li class="h-flex c-key-value-list__item" itemprop="additionalProperty" itemscope itemtype="http://schema.org/PropertyValue">
            <span class="c-key-value-list__key">Hybridiser</span>
            @if(count($plant->breeders) == 0)
                <span class="c-key-value-list__value" itemprop="value"><em>Unregistered</em></span>
            @endif
            @foreach ($plant->breeders as $breeder)
                @if ($loop->count == 1)
                    <a href="{{ URL::route('breeder', $breeder->slug) }}" class="c-key-value-list__value h-anchor--branded" itemprop="additionalProperty" itemscope itemtype="http://schema.org/PropertyValue">
                        <meta itemprop="name" content="Hybridiser">
                        <span itemprop="value" title="View all daylilies hybridised by {{ $breeder->full_name }}">{{ $breeder->full_name }}</span>
                    </a>
                @else
                    @if ($loop->iteration == 1)
                    <span class="c-key-value-list__value" itemprop="additionalProperty" itemscope itemtype="http://schema.org/PropertyValue">
                    @endif
                        <meta itemprop="name" content="Hybridiser">
                        <a itemprop="value" href="{{ URL::route('breeder', $breeder->slug) }}" class="h-anchor--branded" title="View all daylilies hybridised by {{ $breeder->full_name }}">{{ $breeder->full_name }}</a>{{ $loop->remaining > 0 ? ', ' : null }}
                    @if ($loop->remaining == 0)
                    </span>
                    @endif
                @endif
            @endforeach
        </li>
        <li class="h-flex c-key-value-list__item" itemprop="additionalProperty" itemscope itemtype="http://schema.org/PropertyValue">
            <span class="c-key-value-list__key" itemprop="name">Foliage type</span>
            <a href="{{ URL::route('plants.foliage', strtolower($plant->foliage->name)) }}" class="c-key-value-list__value h-anchor--branded" itemprop="value">{{ $plant->foliage->name }}</a>
        </li>
        <li class="h-flex c-key-value-list__item" itemprop="additionalProperty" itemscope itemtype="http://schema.org/PropertyValue">
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
    <a href="{{ request()->headers->get('referer') }}" class="c-button c-button--default">Back</a>
@endsection

@section('layout-footer')
    @parent
@endsection

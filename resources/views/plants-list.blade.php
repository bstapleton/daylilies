@extends('layout.default')

@section('layout-header')
    @parent
@endsection

@section('content')
    @include('partials.plants-introduction')
    <ul class="c-plant-list" itemscope itemtype="https://schema.org/ItemList">
        @foreach($plants as $key => $plant)
            <li class="h-list--unstyled" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <meta itemprop="position" content="{{ $key + 1 }}">
                <article class="h-flex c-plant-list__item">
                    <link itemprop="additionalType" href="http://www.productontology.org/id/Plant" />
                    <div class="c-plant-list__thumbnail">
                        <a href="{{ URL::route('plants.view', $plant->slug) }}" title="View details for {{ $plant->name }}"><img class="c-plant-list__image" itemprop="image" loading="lazy" src="{{ $plant->thumbnail }}" alt="{{ $plant->name }}" /></a>
                    </div>
                    <div class="c-plant-list__detail">
                        <header class="c-plant-list__header{{ $plant->year_added > (Date('Y') - 1) ? ' c-plant-list__header--new' : null }}{{ !$plant->in_stock ? ' c-plant-list__header--out' : null }}">
                            <h2 itemprop="name" class="c-plant-list__title{{ !$plant->in_stock ? ' c-plant-list__title--out' : null }}">{{ $plant->name }}</h2>
                            @isset($plant->icon)
                                <i class="c-plant-list__icon">{!! $plant->icon !!}</i>
                            @endisset
                        </header>
                        <div class="c-plant-list__content h-flex">
                            <div class="c-plant-list__description">
                                <meta itemprop="url" itemscope content="{{ URL::route('plants.view', $plant->slug) }}">
                                <p>
                                    @foreach ($plant->hybridisers as $hybridiser)
                                        <span itemprop="additionalProperty" itemscope itemtype="https://schema.org/PropertyValue">
                                            <meta itemprop="name" content="Hybridiser">
                                            <span itemprop="value">{{ $hybridiser->full_name }}</span>
                                        </span>
                                        @if ($loop->remaining > 0)
                                            &amp;
                                        @endif
                                    @endforeach
                                    <span itemprop="additionalProperty" itemscope itemtype="https://schema.org/PropertyValue">
                                        <meta itemprop="name" content="Year introduced">
                                        (<span itemprop="value">{{ $plant->year_hybridised }}</span>)
                                    </span>
                                    <span itemprop="description">{{ $plant->description }}</span>
                                </p>
                                <ul class="h-list--unstyled h-list--no-spacing h-flex">
                                    <li class="h-list--horizontal__item c-tag" itemprop="additionalProperty" itemscope itemtype="https://schema.org/PropertyValue">
                                        <meta itemprop="name" content="Ploidy">
                                        <span itemprop="value">{{ $plant->genome->name }}</span>
                                    </li>
                                    <li class="h-list--horizontal__item c-tag" itemprop="additionalProperty" itemscope itemtype="https://schema.org/PropertyValue">
                                        <meta itemprop="name" content="Foliage type">
                                        <span itemprop="value">{{ $plant->foliage->name }}</span>
                                    </li>
                                    @foreach ($plant->seasons as $season)
                                        <li class="h-list--horizontal__item c-tag" itemprop="additionalProperty" itemscope itemtype="https://schema.org/PropertyValue">
                                            <meta itemprop="name" content="Bloom time">
                                            <span itemprop="value">{{ $season->name }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="c-plant-list__stock">
                                <p class="i">
                                    &pound;<span>{{ $plant->price }}</span>
                                    {{ $plant->in_stock ? 'In' : 'Out of' }} stock
                                </p>
                                <a href="{{ URL::route('plants.view', $plant->slug) }}" title="View details for {{ $plant->name }}" class="c-button--default c-button--block">View Details</a>
                                @if ($plant->in_stock == true)
{{--                                    <a href="#" class="c-button--success">Add to order</a>--}}
                                @endif
                            </div>
                        </div>
                    </div>
                </article>
            </li>
        @endforeach
    </ul>

    @if ($plants instanceof \Illuminate\Pagination\LengthAwarePaginator)
        {{ $plants->links() }}
    @endif
@endsection

@section('layout-footer')
    @parent
@endsection

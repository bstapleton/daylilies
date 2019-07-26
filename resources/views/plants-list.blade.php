@extends('layout.default')

@section('layout-header')
    @parent
@endsection

@section('content')
    @include('partials.plants-introduction')
    <ul class="c-plant-list">
        @foreach($plants as $plant)
            <li class="h-list--unstyled">
                <article class="h-flex c-plant-list__item" itemscope itemtype="http://schema.org/Product">
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
                        <meta itemprop="sku" content="{{ $plant->category->name }}{{ $plant->id }}">
                        <meta itemprop="mpn" content="{{ $plant->category->name }}{{ $plant->id }}">
                        <div class="c-plant-list__content h-flex">
                            <div class="c-plant-list__description">
                                <p itemprop="description">
                                    @foreach ($plant->breeders as $breeder)
                                        <span itemprop="additionalProperty" itemscope itemtype="http://schema.org/PropertyValue">
                                            <meta itemprop="name" content="Hybridiser">
                                            <span itemprop="value">{{ $breeder->full_name }}</span>
                                        </span>
                                        @if ($loop->remaining > 0)
                                            &amp;
                                        @endif
                                    @endforeach
                                    <span itemprop="additionalProperty" itemscope itemtype="http://schema.org/PropertyValue">
                                        <meta itemprop="name" content="Year introduced">
                                        (<span itemprop="value">{{ $plant->year_bred }}</span>)
                                    </span>
                                    {{ $plant->description }}
                                </p>
                                <ul class="h-list--unstyled h-list--no-spacing h-flex">
                                    <li class="h-list--horizontal__item c-tag" itemprop="additionalProperty" itemscope itemtype="http://schema.org/PropertyValue">
                                        <meta itemprop="name" content="Ploidy">
                                        <span itemprop="value">{{ $plant->genome->name }}</span>
                                    </li>
                                    <li class="h-list--horizontal__item c-tag" itemprop="additionalProperty" itemscope itemtype="http://schema.org/PropertyValue">
                                        <meta itemprop="name" content="Foliage type">
                                        <span itemprop="value">{{ $plant->foliage->name }}</span>
                                    </li>
                                    @foreach ($plant->seasons as $season)
                                        <li class="h-list--horizontal__item c-tag" itemprop="additionalProperty" itemscope itemtype="http://schema.org/PropertyValue">
                                            <meta itemprop="name" content="Bloom time">
                                            <span itemprop="value">{{ $season->name }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="c-plant-list__stock">
                                <p class="i" itemprop="offers" itemscope itemtype="http://schema.org/Offer" itemid="#offer">
                                    <meta itemprop="url" content="http://alacartedaylilies.co.uk/large/airs_and_graces.jpg">
                                    <meta itemprop="priceCurrency" content="GBP">&pound;<span itemprop="price">{{ $plant->price }}</span>
                                    @if ($plant->in_stock == true)
                                        <link itemprop="availability" href="http://schema.org/InStock" />In stock
                                    @else
                                        <link itemprop="availability" href="http://schema.org/OutOfStock" />Out of stock
                                    @endif
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

@extends('layout.default')

@section('layout-header')
    @parent
@endsection

@section('content')
    <h1 class="h-heading l-page-content__title">
    @if($isCategoryView)
        {{ $plants->first()->category->first()->name }} daylilies
    @else
        Daylily listings
    @endif
    </h1>
    @if($isCategoryView)
        <div class="c-card c-card--light">
        {!! $plants->first()->category()->first()->description !!}
        </div>
    @endif
    <div class="c-card c-card--light">
        <p>To view more details and a larger image of each plant, please click on the thumbnail, or the 'View details' buttons.</p>
        <p>It should be noted that entries on the website are only those for which we currently have photographs. If you can't find what you are after, please make an enquiry by going to the <a href="{{ URL::route('contact-us') }}">Contact Us</a> page.</p>
        <p>All photographs on this website were taken in our garden and accurately show how daylilies grow in an english climate. Please do not reuse these images without permission.</p>
    </div>
    <ul class="c-plant-list">
        @foreach($plants as $plant)
            <li class="h-list--unstyled c-plant-list__item">
                <article class="h-flex" itemscope itemtype="http://schema.org/Product">
                    <link itemprop="additionalType" href="http://www.productontology.org/id/Plant" />
                    <div class="c-plant-list__thumbnail">
                        <a href="{{ URL::route('plants.view', $plant->slug) }}" title="View details for {{ $plant->name }}"><img class="c-plant-list__image" itemprop="image" loading="lazy" src="{{ $plant->thumbnail }}" alt="" /></a>
                    </div>
                    <div class="c-plant-list__detail">
                        <h2 itemprop="name" class="c-plant-list__title">{{ $plant->name }}</h2>
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
                                <table class="c-stats-table">
                                    <tr itemprop="additionalProperty" itemscope itemtype="http://schema.org/PropertyValue">
                                        <th itemprop="name">Height</th>
                                        <td>
                                            <span itemprop="value">{{ $plant->height }}</span><meta itemprop="unitCode" content="inches">"
                                            (<span itemprop="value">{{ $plant->heightInCm }}</span><meta itemprop="unitCode" content="centimetres">cm)
                                        </td>
                                    </tr>
                                    <tr itemprop="additionalProperty" itemscope itemtype="http://schema.org/PropertyValue">
                                        <th itemprop="name">Flower size</th>
                                        <td>
                                            <span itemprop="value">{{ $plant->flower_size }}</span><meta itemprop="unitCode" content="inches">"
                                            (<span itemprop="value">{{ $plant->flowerInCm }}</span><meta itemprop="unitCode" content="centimetres">cm)
                                        </td>
                                    </tr>
                                </table>
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
                                <a href="{{ URL::route('plants.view', $plant->slug) }}" title="View details for {{ $plant->name }}" class="c-button c-button--default">View Details</a>
                                @if ($plant->in_stock == true)
{{--                                    <a href="#" class="c-button c-button--success">Add to order</a>--}}
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

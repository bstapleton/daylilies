@extends('layout.default')

@section('layout-header')
    @parent
@endsection

@section('content')
    <h1 class="h-heading l-page-content__title">{{$category}}</h1>
    <ul class="c-plant-list">
        @foreach($plants as $plant)
            <li class="h-list--unstyled c-plant-list__item">
                <?php /*
                <article class="h-flex">
                    <div class="c-plant-list__thumbnail">
                        <img class="c-plant-list__image" src="https://picsum.photos/id/2/150/150" alt="thing" />
                    </div>
                    <div class="c-plant-list__content">
                        <h2 class="c-plant-list__title">{{$plant->name}}</h2>
                        <p>{{$plant->description}}</p>
                    </div>
                    <div class="c-plant-list__stock">
                        @if ($plant->in_stock)
                            <p>In stock</p>
                        @else
                            <p>Out of stock</p>
                        @endif
                        {{$plant->price}}
                    </div>
                </article>
                */ ?>




                <article class="h-flex" itemscope itemtype="http://schema.org/Product">
                    <link itemprop="additionalType" href="http://www.productontology.org/id/Plant" />
                    <div class="c-plant-list__thumbnail">
                        <img class="c-plant-list__image" itemprop="image" src="{{asset('images/thumbnails/' . $plant->slug . '.jpg')}}" alt="{{$plant->name}}" />
                    </div>
                    <div class="c-plant-list__detail">
                        <h2 itemprop="name" class="c-plant-list__title">{{$plant->name}}</h2>
                        <meta itemprop="sku" content="{{$plant->type}}{{$plant->id}}">
                        <meta itemprop="mpn" content="{{$plant->type}}{{$plant->id}}">
                        <div class="c-plant-list__content h-flex">
                            <div class="c-plant-list__description">
                                <p itemprop="description">
                                    <span itemprop="additionalProperty" itemscope itemtype="http://schema.org/PropertyValue">
                                        <meta itemprop="name" content="Hybridiser">
                                        <span itemprop="value">{{$plant->breeder}}</span>
                                    </span>
                                    <span itemprop="additionalProperty" itemscope itemtype="http://schema.org/PropertyValue">
                                        <meta itemprop="name" content="Year introduced">
                                        (<span itemprop="value">{{$plant->year_bred}}</span>)
                                    </span>
                                    {{$plant->description}}
                                </p>
                                <ul class="h-list--unstyled h-list--no-spacing h-flex">
                                    <li class="h-list--horizontal__item c-plant-list__tag" itemprop="additionalProperty" itemscope itemtype="http://schema.org/PropertyValue">
                                        <meta itemprop="name" content="Ploidy">
                                        <span itemprop="value">{{$plant->genome}}</span>
                                    </li>
                                    <li class="h-list--horizontal__item c-plant-list__tag" itemprop="additionalProperty" itemscope itemtype="http://schema.org/PropertyValue">
                                        <meta itemprop="name" content="Foliage type">
                                        <span itemprop="value">{{$plant->foliage}}</span>
                                    </li>
                                    <li class="h-list--horizontal__item c-plant-list__tag" itemprop="additionalProperty" itemscope itemtype="http://schema.org/PropertyValue">
                                        <meta itemprop="name" content="Bloom time">
                                        <span itemprop="value">{{$plant->season}}</span>
                                    </li>
                                </ul>
                                <table class="stats">
                                    <tr itemprop="additionalProperty" itemscope itemtype="http://schema.org/PropertyValue">
                                        <th itemprop="name">Height</th>
                                        <td>
                                            <span itemprop="value">{{$plant->height}}</span>
                                            <meta itemprop="unitCode" content="inches">"
                                            (<span itemprop="value">{{$plant->heightInCm}}</span><meta itemprop="unitCode" content="centimetres">cm)
                                        </td>
                                    </tr>
                                    <tr itemprop="additionalProperty" itemscope itemtype="http://schema.org/PropertyValue">
                                        <th itemprop="name">Flower size</th>
                                        <td>
                                            <span itemprop="value">{{$plant->flower_size}}</span>
                                            <meta itemprop="unitCode" content="inches">"
                                            (<span itemprop="value">{{$plant->flowerInCm}}</span><meta itemprop="unitCode" content="centimetres">cm)
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div class="c-plant-list__stock">
                                <p class="i" itemprop="offers" itemscope itemtype="http://schema.org/Offer" itemid="#offer">
                                    <meta itemprop="url" content="http://alacartedaylilies.co.uk/large/airs_and_graces.jpg">
                                    <meta itemprop="priceCurrency" content="GBP">&pound;
                                    <span itemprop="price">{{$plant->price}}</span>
                                    @if ($plant->in_stock == true)
                                        <link itemprop="availability" href="http://schema.org/InStock" />In stock
                                    @else
                                        <link itemprop="availability" href="http://schema.org/OutOfStock" />Out of stock
                                    @endif
                                </p>
                                <a href="#" class="c-button c-button--default">View Details</a>
                                @if ($plant->in_stock == true)
                                    <a href="#" class="c-button c-button--success">Add to order</a>
                                @endif
                            </div>
                        </div>

                    </div>

                </article>
            </li>
        @endforeach
    </ul>

    {{$plants->links()}}
@endsection

@section('layout-footer')
    @parent
@endsection

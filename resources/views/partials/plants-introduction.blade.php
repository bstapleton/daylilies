<h1 class="h-heading l-page-content__title">
    @if($isCategoryView)
        {{ $plants->first()->category->first()->name }} daylilies
    @elseif(isset($pageHeading))
        {{ $pageHeading }}
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
    @if($isCategoryView)
        <p>To view more details and a larger image of each plant, please click on the thumbnail, or the 'View details' buttons.</p>
    @endif
    <p>All photographs on this website were taken in our garden and accurately show how daylilies grow in an english climate. Please do not reuse these images without permission.</p>
</div>
@isset($isNewPlantsGrid)
    <div class="c-plant-view-controls">
        <ul class="h-list--horizontal h-list--unstyled h-flex--align-center h-flex--justify-right h-no-padding">
            <li class="h-list--horizontal__item">Filter:</li>
            <li class="h-list--horizontal__item">
                @if(Request::get('category'))
                    <a class="c-button--default" href="{{ route('plants.new') }}">All</a>
                @else
                    <a class="c-button--default" href="#" disabled=disabled>All</a>
                @endif
            </li>
            <li class="h-list--horizontal__item">
                <a class="c-button--default" {{ app('request')->input('category') == 'large' ? 'href=# disabled=disabled' : 'href=?category=large' }}>Large</a>
            </li>
            <li class="h-list--horizontal__item">
                <a class="c-button--default" {{ app('request')->input('category') == 'small' ? 'href=# disabled=disabled' : 'href=?category=small' }}>Small</a>
            </li>
            <li class="h-list--horizontal__item">
                <a class="c-button--default" {{ app('request')->input('category') == 'miniature' ? 'href=# disabled=disabled' : 'href=?category=miniature' }}>Miniature</a>
            </li>
            <li class="h-list--horizontal__item">
                <a class="c-button--default" {{ app('request')->input('category') == 'spider' ? 'href=# disabled=disabled' : 'href=?category=spider' }}>Spider</a>
            </li>
        </ul>
    </div>
@endisset
@isset($pageNumberList)
<div class="c-plant-view-controls h-flex">
    <ul class="h-list--horizontal h-list--unstyled h-flex--align-center h-flex--grow h-no-padding">
        <li class="h-list--horizontal__item h-flex h-flex--align-center"><span class="h-text--bold h-margin-right__default">Key:</span> {!! $thisYearIcon !!} New for {{ date('Y') }}</li>
        <li class="h-list--horizontal__item h-flex h-flex--align-center">{!! $lastYearIcon !!} Added in {{ date('Y') - 1 }}</li>
        <li class="h-list--horizontal__item h-flex h-flex--align-center">{!! $outOfStockIcon !!} Out of stock</li>
    </ul>
    <ul class="h-list--horizontal h-list--unstyled h-flex--align-center h-flex--justify-right h-no-padding">
        <li class="h-list--horizontal__item">View as:</li>
        <li class="h-list--horizontal__item">
            <a class="c-button--default c-button--icon" {{ app('request')->input('display') == 'grid' ? 'href=?page=' . $pageNumberList : 'href=# disabled=disabled' }}><img src="{{ asset('images/icon-list.svg') }}" alt="" class="c-button__icon" />List</a>
        </li>
        <li class="h-list--horizontal__item">
            <a class="c-button--default c-button--icon" href="?display=grid&amp;page={{ $pageNumberGrid }}"><img src="{{ asset('images/icon-grid.svg') }}" alt="" class="c-button__icon" />Grid</a>
        </li>
    </ul>
</div>
@endisset

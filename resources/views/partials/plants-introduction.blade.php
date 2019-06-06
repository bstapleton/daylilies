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
    <p>To view more details and a larger image of each plant, please click on the thumbnail, or the 'View details' buttons.</p>
    <p>It should be noted that entries on the website are only those for which we currently have photographs. If you can't find what you are after, please make an enquiry by going to the <a href="{{ URL::route('contact-us') }}">Contact Us</a> page.</p>
    <p>All photographs on this website were taken in our garden and accurately show how daylilies grow in an english climate. Please do not reuse these images without permission.</p>
</div>
@isset($pageNumberList)
<div class="c-plant-view-controls">
    <ul class="h-list--horizontal h-list--unstyled h-flex--align-center h-flex--justify-right h-no-padding">
        <li class="h-list--horizontal__item">View as:</li>
        <li class="h-list--horizontal__item">
            <a class="c-button--default" {{ app('request')->input('display') == 'grid' ? 'href=?page=' . $pageNumberList : 'href=# disabled=disabled' }} href="?page={{ $pageNumberList }}">List</a>
        </li>
        <li class="h-list--horizontal__item"><a class="c-button--default" href="?display=grid&amp;page={{ $pageNumberGrid }}">Grid</a></li>
    </ul>
</div>
@endisset

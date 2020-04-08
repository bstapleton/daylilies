@extends('layout.default')

@section('layout-header')
    @parent
@endsection

@section('content')
    <div itemscope itemtype="https://schema.org/Organization">
        <h1 class="h-heading l-page-content__title">Contact <span itemprop="name">A La Carte Daylilies</span></h1>
        <div class="c-card c-card--light">
            <p>By E-mail If you have any questions or queries send an email to <span itemprop="email"><a href="mailto:andy@alacartedaylilies.co.uk">andy@alacartedaylilies.co.uk</a></span></p>
            <p>To place an order, please use our printable online order form, or use the mailing address listed below to receive our full catalogue.</p>
        </div>
        <div class="c-card c-card--light">
            <p>By Post Alternatively, if you'd like to send an order or request a catalogue by post, please send all correspondence to:</p>
            <address itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
                <span itemprop="streetAddress">Little Hermitage<br />
                    St. Catherine's Down<br /></span>
                <span itemprop="addressLocality">Nr. Ventnor<br />
                    Isle of Wight<br /></span>
                <span itemprop="postalCode">PO38 2PD<br /></span>
                <span itemprop="country">United Kingdom</span>
            </address>
        </div>
        <div class="c-card c-card--light">
            <p>We can also be reached by phone between <span itemprop="openingHours" content="Mo-Su 9:00-17:00">9am and 5pm</span> on the following number:<br />
                <span itemprop="telephone">(+44) 01983 730512</span></p>
        </div>
    </div>
@endsection

@section('layout-footer')
    @parent
@endsection

@extends('layout.default')

@section('layout-header')
    @parent
@endsection

@section('content')
    <h1 class="h-heading l-page-content__title">Server error</h1>
    <div class="c-card c-card--light">
        @isset($message)
            <p>{{message}}</p>
        @else
            <p>The results requested do not exist.</p>
        @endisset
    </div>
    <a href="javascript:history.back()">Go back</a>
@endsection

@section('layout-footer')
    @parent
@endsection

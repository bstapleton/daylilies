@extends('layout.plant-view')

@section('layout-header')
    @parent
@endsection

@section('content')
    <figure class="c-lightbox h-flex h-flex--column">
        <img src="{{ asset('images/plants/' . $plant->slug . '.jpg') }}" alt="Photo of {{ $plant->name }}" class="c-lightbox__image" />
        <figcaption class="c-lightbox__caption"><i>Hemerocallis</i> '{{ $plant->name }}'</figcaption>
    </figure>
@endsection

@section('sidebar')
    <h1>{{ $plant->name }}</h1>
    <p>{{ $plant->description }}</p>
@endsection

@section('layout-footer')
    @parent
@endsection

@extends('layout.default')

@section('layout-header')
    @parent
@endsection

@section('content')
    <h1>{{ $plant->name }}</h1>
    <p>{{ $plant->description }}</p>
@endsection

@section('layout-footer')
    @parent
@endsection

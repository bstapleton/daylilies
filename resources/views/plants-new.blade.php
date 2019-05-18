@extends('layout.default')

@section('layout-header')
    @parent
@endsection

@section('content')
    <h2>{{ date('Y') }}</h2>
    <ul>
        @foreach($thisYear as $plant)
            <li>{{ $plant->name }}</li>
        @endforeach
    </ul>

    <h2>{{ date('Y') - 1 }}</h2>
    <ul>
        @foreach($lastYear as $plant)
            <li>{{ $plant->name }}</li>
        @endforeach
    </ul>
@endsection

@section('layout-footer')
    @parent
@endsection

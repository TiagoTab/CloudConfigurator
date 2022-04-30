@extends('layout')
@section('content')
    <link href="{{ URL::asset('css/layout.css') }}" rel="stylesheet" type="text/css">
    <div class="filter-component">
    <h1>Find your server <span
            class="server-icon">{!! File::get('images/icons/icon_servers.svg') !!}</span></h1>
    <div id="app">
        <configurator-component :initial_data='@json($configuratorLimits)'></configurator-component>
    </div>
    </div>
    <button onclick="topFunction()" id="btn-top" title="Go to top">Up</button>
@endsection
@section('js')
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/up.js') }}"></script>
@endsection

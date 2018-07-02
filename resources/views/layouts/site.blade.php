@extends('blogger::layouts.base')

@section('main')
    <div class="fixed-header">
        @include('blogger::partials.menu')
    </div>
    <div class="content">
        @yield('content')
    </div>

    @include('blogger::partials.footer')
@stop


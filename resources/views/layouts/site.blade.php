@extends('blogger::layouts.base')

@section('main')
    <div class="fixed-header bg-primary">
        @include('blogger::partials.menu')
    </div>
    <div class="content margin-vertical-1">
        @yield('content')
    </div>

    @include('blogger::partials.footer')
@stop


@extends('blogger::layouts.base')

@section('main')
    @if(!empty($menu))
    <div class="fixed-header bg-primary">
        @include('blogger::partials.menu')
    </div>
    @endif
    <div class="content margin-vertical-1">
        @yield('content')
    </div>

    @include('blogger::partials.footer')
@stop


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

{{--@extends('admin.layouts.site')--}}

{{--@push('stylesheets')--}}
    {{--<link rel="stylesheet" href="{{ blog_assets('css/app.css') }}">--}}
{{--@endpush--}}

{{--@push('scripts')--}}
    {{--<script type="text/javascript" src="{{ blog_assets('js/app.js') }}"></script>--}}
{{--@endpush--}}


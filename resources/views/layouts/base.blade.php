<!DOCTYPE html>
<html>
<head lang="en-US">
    @include('blogger::partials.metas')

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
          integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}"/>
    {{--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>--}}
    @foreach (config('blogger.stylesheets') as $stylesheet)
        <link rel="stylesheet" href="{{ $stylesheet }}">
    @endforeach
    <link rel="stylesheet" href="{{ blog_assets('css/app.css') }}">
</head>
<body class="{{$page['slug'] or 'generic'}} {{$bodyClass or ''}}">

<div id="myApp">
    @yield('main')
</div>

@foreach (config('blogger.scripts') as $scripts)
    <script type="text/javascript" src="{{ $scripts }}"></script>
@endforeach
<script type="text/javascript" src="{{ blog_assets('js/app.js') }}"></script>

</body>
</html>

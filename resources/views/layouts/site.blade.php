<!DOCTYPE html>
<html>
<head lang="en-US">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-COMPATIBLE" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta property="og:url" content="{{ env('APP_URL')  }}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="Title Here"/>
    <meta property="og:description" content="Description Here"/>
    <meta property="og:image" content="Image Here"/>
    <title>Title Here</title>
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
    <div class="content margin-vertical-1">
        @yield('content')
    </div>
</div>

@foreach (config('blogger.scripts') as $scripts)
    <script type="text/javascript" src="{{ $scripts }}"></script>
@endforeach
<script type="text/javascript" src="{{ blog_assets('js/app.js') }}"></script>

</body>
</html>

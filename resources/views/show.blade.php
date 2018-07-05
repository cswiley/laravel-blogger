@extends('blogger::layouts.site', ['bodyClass' => ''])

@section ('content')

    <div class="row">
        <div class="column small-12">
            @if (! empty($isPreview))
                <div class="callout alert margin-top-1">Preview mode</div>
            @else
                <div class="callout alert margin-top-1">
                    <ul>
                        @if($blog['is_active'])
                            <li>
                                <strong>Public URL: </strong><a href="{{ blog_public_path($blog['slug']) }}">{{ url(blog_public_path($blog['slug'])) }}</a>
                            </li>
                        @endif
                        <li>
                            <strong>Status: </strong>{{ $blog['visibility_eng'] }}
                        </li>
                        <li>
                            <strong>Published at: </strong>{{ $blog['published_at'] }}
                        </li>
                    </ul>

                </div>
            @endif

            @if (! empty($blog['image_url']))
                <img src="{{ $blog['image_url'] }}" alt="">
            @endif
            <h1>{{ $blog['title'] }}</h1>

            <div class="blog-content">
                {!! $blog['content'] !!}
            </div>
        </div>
    </div>
@stop
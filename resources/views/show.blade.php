@extends('blogger::layouts.site', ['bodyClass' => ''])

@section ('content')

    <div class="row">
        <div class="column small-12">
            @if (! empty($isPreview))
                <div class="callout alert margin-top-1">Preview mode</div>
            @elseif (! $blog['is_active'])
                <div class="callout alert margin-top-1">
                    <ul>
                        <li>
                            <strong>Status: </strong>{{ $blog['visibility_eng'] }}
                        </li>
                        <li>
                            <strong>Publish at: </strong>{{ $blog['published_at'] }}
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
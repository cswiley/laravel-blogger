@extends('blogger::layouts.site', ['bodyClass' => ''])

@section ('content')
    <div class="row">
        <div class="column small-12">
            <nav aria-label="You are here:" role="navigation">
                <ul class="breadcrumbs">
                    <li><a href="{{ blog_path() }}">{{ config('blogger.title_plural') }}</a></li>
                    <li>
                        <span class="show-for-sr">Current: </span> New {{ config('blogger.title') }}
                    </li>
                </ul>
            </nav>
            <h1>Add new {{ config('blogger.title') }}</h1>
            <blog-editor options="{{ $options }}" action="{{ blog_path() }}"></blog-editor>
        </div>
    </div>
@stop
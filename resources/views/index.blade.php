@extends('blogger::layouts.site', ['bodyClass' => ''])


@section ('content')
    <div class="row">
        <div class="column small-12">
            <h1 class="display-inline-block">{{ config('blogger.title_plural') }}</h1>
            <a target="_blank" href="{{ blog_admin_path('create') }}" class="button hollow tiny radius margin-left-1">+ Add New</a>
            <blog-manager path="{{ blog_admin_path() }}" permalink="{{ blog_public_path()  }}"></blog-manager>
        </div>
    </div>
@stop

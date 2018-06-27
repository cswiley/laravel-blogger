@extends('blogger::layouts.site', ['bodyClass' => ''])

@section ('content')
    <div class="row">
        <div class="column small-12">
            <h1>Add new post</h1>
            <blog-editor options="{{ $options }}" action="{{ blog_url() }}"></blog-editor>
        </div>
    </div>
@stop
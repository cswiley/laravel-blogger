@extends('blog::layouts.site', ['bodyClass' => ''])

@section ('content')
    <div class="row">
        <div class="column small-12">
            <h1>Add new post</h1>
            <blog-editor data-options="{{ $options }}"></blog-editor>
        </div>
    </div>
@stop
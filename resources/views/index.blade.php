@extends('layouts.site', ['bodyClass' => ''])


@section ('content')
    <div class="row">
        <div class="column small-12">
            <h1 class="display-inline-block">Posts</h1>
            <a target="_blank" href="/blog/create" class="button hollow tiny radius margin-left-1">+ Add New</a>
            <blog-manager></blog-manager>
        </div>
    </div>
@stop

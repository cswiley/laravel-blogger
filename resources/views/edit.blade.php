@extends('layouts.site', ['bodyClass' => ''])

@section ('content')
    <div class="row">
        <div class="column small-12">
            <nav aria-label="You are here:" role="navigation">
                <ul class="breadcrumbs">
                    <li><a href="/blog">All Posts</a></li>
                    <li>
                        <span class="show-for-sr">Current:</span> {{ $blog->slug }}
                    </li>
                </ul>
            </nav>
            <h1 class="display-inline-block">Edit post</h1>
            <a target="_blank" href="/blog/create" class="button hollow tiny radius margin-left-1">+ Add New</a>
            <blog-editor data-id="<?php echo $blog->id ?>"></blog-editor>
        </div>
    </div>
@stop
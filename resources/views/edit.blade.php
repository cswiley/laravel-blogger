@extends('blogger::layouts.site', ['bodyClass' => ''])

@section ('content')
    <div class="row">
        <div class="column small-12">
            <nav aria-label="You are here:" role="navigation">
                <ul class="breadcrumbs">
                    <li><a href="{{ blog_path() }}">All {{ config('blogger.title_plural') }}</a></li>
                    <li>
                        <span class="show-for-sr">Current:</span> {{ $blog->id }}
                        <?php if ($blog->title) : ?>
                        <span> - {{ $blog->title }}</span>
                        <?php endif; ?>
                    </li>
                </ul>
            </nav>
            <div class="blog-header">
                <h1 class="display-inline-block">Edit {{ config('blogger.title') }}</h1>
                <a target="_blank" href="{{ blog_admin_url('create') }}" class="button hollow tiny radius margin-left-1">+ Add New</a>
            </div>
            <div class="blog-permalink margin-bottom-1">
            </div>
            <blog-editor id="<?php echo $blog->id ?>" action="{{ blog_path() }}" url="{{ blog_url() }}"></blog-editor>
        </div>
    </div>
@stop
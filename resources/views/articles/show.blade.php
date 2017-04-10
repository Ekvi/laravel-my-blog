@extends('layouts.sidebar')

@section('content')

    <div class="show-article">
        <div class="header clearfix">
            <div class="title clearfix">
                {{ $article->category['title'] }} / {{ $article->created_at->diffForHumans() }}
            </div>
        </div>

        @if (!empty($article->image))
            <div class="image-header">
                <img src="/images/articles/{{ $article->image }}" class="img-responsive">
            </div>
        @endif

        <h2 class="article-title">{{ $article->title }}</h2>
        <div class="content">
            {{ $article->content }}
        </div>
        <hr>

        <div class="footer">
            <div class="info">
                <i class="fa fa-user-o" aria-hidden="true"></i> {{ trans('article.posted_by') }} {{ $article->user->name }}

                <i class="fa fa-tags" aria-hidden="true"></i>
                @foreach($article->tags as $tag)
                    <span><a href="/tags/{{ $tag->slug }}">{{ $tag->title}}</a></span>
                @endforeach
            </div>
        </div>
    </div>

@endsection
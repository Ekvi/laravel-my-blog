@extends('layouts.sidebar')

@section('content')

    <div class="article">
        {{ $article->category['title'] }} / {{ $article->created_at->diffForHumans() }}

        @if (!empty($article->image))
            <div class="image-header">
                <img src="/images/articles/{{ $article->image }}" class="img-responsive">
            </div>
        @endif

        <h2>{{ $article->title }}</h2>
        <div>
            {{ $article->content }}
        </div>
        <hr>

        <div class="footer">
            <i class="fa fa-user-o" aria-hidden="true"></i> {{ trans('article.posted_by') }} {{ $article->user->name }}

            <i class="fa fa-tags" aria-hidden="true"></i>
            @foreach($article->tags as $tag)
                <span><a href="/tags/{{ $tag->slug }}">{{ $tag->title}}</a></span>
            @endforeach
            <br><br>
        </div>
    </div>

@endsection
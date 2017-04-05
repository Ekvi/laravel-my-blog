@extends('layouts.sidebar')

@section('content')

    {{--<div class="div">
    <div class="row">
        <div class="col-md-8">
            @foreach($articles as $article)
            <div class="article">
                {{ $article->category['title'] }} / {{ $article->created_at->diffForHumans() }}
                @if (!empty($article->image))
                    <div class="image-header">
                        <img src="/images/articles/{{ $article->image }}" class="img-responsive">
                    </div>
                @endif
                <h2>{{ $article->title }}</h2>
                <div>
                    {{ substr($article->content, 0, 400) . '...' }}
                </div>
                <a href="/articles/{{ $article->id }}">read more</a>
                <hr>
                <i class="fa fa-user-o" aria-hidden="true"></i> Posted by {{ $article->user->name }}
                <i class="fa fa-tags" aria-hidden="true"></i> Tags
                <br><br>
            </div>
            @endforeach
        </div>
        <div class="col-md-4">
            <div>
                {{ substr($articles[3]->content, 0, 400) . '...' }}
            </div>

        </div>
    </div>
    </div>--}}

    @foreach($articles as $article)
        <div class="article">
            {{ $article->category['title'] }} / {{ $article->created_at->diffForHumans() }}
            @if (!empty($article->image))
                <div class="image-header">
                    <img src="/images/articles/{{ $article->image }}" class="img-responsive">
                </div>
            @endif
            <h2>{{ $article->title }}</h2>
            <div>
                {{ substr($article->content, 0, 400) . '...' }}
            </div>
            <a href="/articles/{{ $article->id }}">read more</a>
            <hr>
            <i class="fa fa-user-o" aria-hidden="true"></i> Posted by {{ $article->user->name }}
            <i class="fa fa-tags" aria-hidden="true"></i> Tags
            <br><br>
        </div>
    @endforeach

@endsection
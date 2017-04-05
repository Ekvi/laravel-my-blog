@extends('layouts.sidebar')

@section('content')

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

    <i class="fa fa-user-o" aria-hidden="true"></i> Posted by {{ $article->user->name }}
    <i class="fa fa-tags" aria-hidden="true"></i> Tags

@endsection
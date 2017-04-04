@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
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
            {{ $article->user->name }}
        </div>
    </div>

@endsection
@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
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
                {{ $article->user->name }}
                <br><br>
            </div>
            @endforeach
        </div>
    </div>

@endsection
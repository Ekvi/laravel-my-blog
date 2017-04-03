@extends('layouts.app')

@section('content')

    {{print_r($articles)}}

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            @foreach($articles as $article)
                <h2>{{ $article->title }}</h2>
                <div>
                    {{ $article->content }}
                </div>
            @endforeach
        </div>
    </div>

@endsection
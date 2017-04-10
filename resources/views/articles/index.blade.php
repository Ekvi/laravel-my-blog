@extends('layouts.sidebar')

@section('content')

    <div class="articles">
        @foreach($articles as $article)

            <div class="article clearfix">

                <div class="header clearfix">
                    <div class="title pull-left">
                        {{ $article->category['title'] }} / {{ $article->created_at->diffForHumans() }}
                    </div>

                    @if(Auth::check() && (Auth::user()->id == $article->user->id || Auth::user()->isAdmin() ))
                        <div class="settings pull-right">
                            <div class="clearfix">
                                <div class="pull-left">
                                    <a href="/articles/{{ $article->id }}/edit" class="btn btn-default btn-sm">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    </a>
                                </div>
                                <div class="pull-right">
                                    <form action="/articles/{{ $article->id }}" method="POST">
                                        {{ csrf_field() }}
                                        {{method_field('DELETE')}}
                                        <button type="submit" role="button" class="btn btn-danger btn-sm">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <h2 class="text-center">{{ $article->title }}</h2>

                <div class="content">
                    @if (!empty($article->image))
                            <img src="/images/articles/{{ $article->image }}" class="img-responsive pull-left image-header">
                    @endif
                    {{ substr($article->content, 0, 800) . '...' }}
                    <a href="/articles/{{ $article->slug }}">{{ trans('article.read_more') }}</a>
                </div>

                <hr>
                <div class="footer">
                    <div class="info">
                        <i class="fa fa-user-o fa-1x" aria-hidden="true"></i> {{ trans('article.posted_by') }} {{ $article->user->name }}
                        <i class="fa fa-tags fa-1x" aria-hidden="true"></i>
                        @foreach($article->tags as $tag)
                            <span><a href="/tags/{{ $tag->slug }}">{{ $tag->title}}</a></span>
                        @endforeach
                    </div>
                </div>
            </div>

        @endforeach

        <div class="text-center">
            {{ $articles->links() }}
        </div>

    </div>

@endsection

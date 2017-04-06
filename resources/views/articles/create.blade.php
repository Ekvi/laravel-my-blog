@extends('layouts.app')

@section('stylesheets')
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2>{{ trans('article.create_new_article') }}</h2>
                </div>
                <div class="panel-body">

                    {{--{!! Form::open(['url' => '/articles']) !!}
                    echo Form::token();

                    echo Form::label('title', 'Title', ['class' => 'form-control']);

                    {!! Form::close() !!}--}}

                    <form method="post" action="/articles" class="clearfix" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group {{$errors->has('title') ? 'has-error' : ''}}">
                            <label for="title">{{ trans('article.title') }}</label>
                            <input type="text" class="form-control" name="title" id="title"  placeholder="{{ trans('article.title') }}">
                        </div>

                        <div class="form-group {{$errors->has('description') ? 'has-error' : ''}}">
                            <label for="description">{{ trans('article.description') }}</label>
                            <input type="text" class="form-control" name="description" id="description" placeholder="{{ trans('article.description') }}">
                        </div>

                        <div class="form-group {{$errors->has('content') ? 'has-error' : ''}}">
                            <label for="content">{{ trans('article.content') }}</label>
                            <textarea class="form-control" name="content" id="content" placeholder="{{ trans('article.content') }}"></textarea>
                        </div>

                        <div class="form-group {{$errors->has('category') ? 'has-error' : ''}}">
                            <label for="category">{{ trans('article.category') }}</label>
                            <select id="category" name="category" class="form-control">
                                <option selected disabled>{{ trans('article.category_select') }}</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="tags">{{ trans('article.tags') }}</label>
                            <select id="tags" name="tags[]" class="form-control select2-multiple" multiple="multiple">
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}">{{ $tag->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="image">{{ trans('article.upload') }}</label>
                            <input type="file" id="image" name="image">
                        </div>
                        <button type="submit" class="btn btn-primary pull-right">{{ trans('article.create') }}</button>
                    </form>
                </div>
                <div class="panel-footer">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/select2.min.js') }}"></script>

    <script type="text/javascript">
        $(".select2-multiple").select2();
    </script>
@endsection


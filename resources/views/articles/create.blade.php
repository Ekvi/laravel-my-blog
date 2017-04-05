@extends('layouts.app')

@section('stylesheets')
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2>Create new post</h2>
                </div>
                <div class="panel-body">

                    {{--{!! Form::open(['url' => '/articles']) !!}
                    echo Form::token();

                    echo Form::label('title', 'Title', ['class' => 'form-control']);

                    {!! Form::close() !!}--}}

                    <form method="post" action="/articles" class="clearfix" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" id="title"  placeholder="title">
                        </div>
                        {{--<div class="form-group">
                            <label for="slug">Slug</label>
                            <input type="text" class="form-control" name="slug" id="slug" placeholder="slug">
                        </div>--}}
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" name="description" id="description" placeholder="description">
                        </div>
                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea class="form-control" name="content" id="content" placeholder="content"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select id="category" name="category" class="form-control">
                                <option selected disabled>Please select one option</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tags">Tags</label>
                            <select id="tags" name="tags[]" class="form-control select2-multiple" multiple="multiple">
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}">{{ $tag->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="image">Upload</label>
                            <input type="file" id="image" name="image">
                        </div>
                        <button type="submit" class="btn btn-primary pull-right">Submit</button>
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


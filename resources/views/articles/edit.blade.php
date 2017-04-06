@extends('layouts.app')

@section('stylesheets')
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h2>Update new post</h2>
                </div>
                <div class="panel-body">

                    <form method="post" action="/articles/{{$article->id}}" class="clearfix" enctype="multipart/form-data">
                        {{ method_field('PUT') }}

                        {{ csrf_field() }}

                        <div class="form-group {{$errors->has('title') ? 'has-error' : ''}}">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" id="title"  placeholder="title" value="{{ $article->title }}">
                        </div>

                        <div class="form-group {{$errors->has('description') ? 'has-error' : ''}}">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" name="description" id="description" placeholder="description" value="{{ $article->description }}">
                        </div>

                        <div class="form-group {{$errors->has('content') ? 'has-error' : ''}}">
                            <label for="content">Content</label>
                            <textarea class="form-control" name="content" id="content" placeholder="content">{{ $article->content }}</textarea>
                        </div>

                        <div class="form-group {{$errors->has('category') ? 'has-error' : ''}}">
                            <label for="category">Category</label>
                            <select id="category" name="category" class="form-control">
                                <option selected disabled>Please select one option</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{$article->category_id == $category->id ? 'selected' : ''}}>{{ $category->title }}</option>
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
                            <input type="file" id="image" name="image" value="{{ $article->image }}">
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
        $(".select2-multiple").select2().val({{ json_encode($article->tags()->allRelatedIds()) }}).trigger('change');
    </script>
@endsection


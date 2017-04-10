@extends('layouts.admin')

@section('content')

    <div>
        <a href="{{route('articles.create')}}" class="btn btn-primary">Add Article</a>
    </div>
    <br>
    <table class="table table-bordered table-hover table-striped">
        <thead>
        <tr class="table-header">
            <td>Title</td>
            <td>Author</td>
            <td>Created</td>
            <td>Updated</td>
            <td class="table-centred">Edit</td>
            <td class="table-centred">Delete</td>
        </tr>
        </thead>
        <tbody>
        @foreach($articles as $article)
            <tr>
                <td>{{ $article->title }}</td>
                <td>{{ $article->user->name }}</td>
                <td>{{ $article->created_at }}</td>
                <td>{{ $article->updated_at }}</td>

                <td class="text-center">
                    <a href="/articles/{{ $article->id }}/edit" class="btn btn-default btn-xs">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </a>
                </td>
                <td class="text-center">
                    {{ Form::open(array('url' => '/articles/' . $article->id)) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::button('<i class="fa fa-times"></i>', ['class' => 'btn btn-danger btn-xs', 'role' => 'button', 'type' => 'submit']) }}
                    {{ Form::close() }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="text-center">
        {{ $articles->links() }}
    </div>

@endsection
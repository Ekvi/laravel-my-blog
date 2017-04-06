@extends('layouts.admin')

@section('content')

    <div>
        <a href="/admin/tags/create" class="btn btn-primary">Add Tag</a>
    </div>
    <br>
    <table class="table table-bordered table-hover table-striped">
        <thead>
        <tr class="table-header">
            <td>Title</td>
            <td class="table-centred">Edit</td>
            <td class="table-centred">Delete</td>
        </tr>
        </thead>
        <tbody>
        @foreach($tags as $tag)
            <tr>
                <td>{{ $tag->title }}</td>
                <td class="text-center">
                    <a href="/admin/tags/{{ $tag->id }}/edit" class="btn btn-default btn-xs">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </a>
                </td>
                <td class="text-center">
                    {{ Form::open(array('url' => '/admin/tags/' . $tag->id)) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::button('<i class="fa fa-times"></i>', ['class' => 'btn btn-danger btn-xs', 'role' => 'button', 'type' => 'submit']) }}
                    {{ Form::close() }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
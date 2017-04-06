@extends('layouts.admin')

@section('content')

    <div>
        <a href="/admin/categories/create" class="btn btn-primary">Add Category</a>
    </div>
    <br>
    <table class="table table-bordered table-hover table-striped">
        <thead>
        <tr class="table-header">
            <td>Name</td>
            <td>Created</td>
            <td>Updated</td>
            <td class="table-centred">Edit</td>
            <td class="table-centred">Delete</td>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{ $category->title }}</td>
                {{--<td>{{ strtotime($category->created_at ) }}</td>--}}
                <td>{{ $category->created_at }}</td>
                <td>{{ $category->updated_at }}</td>

                <td class="text-center"><a href="/admin/categories/{{ $category->id }}/edit" class="btn btn-default btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                <td class="text-center">
                    {{ Form::open(array('url' => '/admin/categories/' . $category->id)) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::button('<i class="fa fa-times"></i>', ['class' => 'btn btn-danger btn-xs', 'role' => 'button', 'type' => 'submit']) }}
                    {{ Form::close() }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
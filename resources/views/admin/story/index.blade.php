@extends('admin.layout.app')
@section('css-include')
    <link rel="stylesheet" href="{{ asset('admin/plugins/DataTables/datatables.min.css') }}">
@endsection
@section('page-option')
    <a href="{{ route('admin.story.add') }}" class="btn btn-primary">Add Story</a>
@endsection
@section('s-title')
    <li class="breadcrumb-item active">Story</li>
@endsection
@section('content')
    <table class="table">
        <tr>
            <th>
                Image
            </th>
            <th>
                Title
            </th>
            <th>
                Changes
            </th>
        </tr>
        @foreach ($stories as $story)
            <tr>
                <td>
                    <img src="{{ asset($story->image) }}" class="w-60 h-40">
                </td>
                <td>
                    {{ $story->title }}
                </td>
                <td>
                    <a href="{{ route('admin.story.edit', ['story' => $story->id]) }}" class="btn btn-primary">Edit</a>
                    <a href="{{ route('admin.story.del', ['story' => $story->id]) }}" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection

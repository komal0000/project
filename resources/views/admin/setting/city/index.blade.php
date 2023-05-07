@extends('admin.layout.app')
@section('css-include')
    <link href="{{ asset('admin/plugins/DataTables/datatables.min.css') }}" rel="stylesheet">

@endsection
@section('page-option')
    <a type="button" class="btn btn-primary" href="{{route('admin.setting.city.add')}}">Add City</a>
@endsection
@section('s-title')
    <li class="breadcrumb-item">Setting</li>
    <li class="breadcrumb-item">Cities</li>
@endsection
@section('content')

@endsection
@section('script')

    <script src="{{asset('admin/plugins/DataTables/datatables.min.js')}}"></script>
    <script>

    </script>
@endsection

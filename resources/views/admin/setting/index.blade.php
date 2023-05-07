@extends('admin.layout.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/drophify/css/dropify.min.css') }}">
    <style>
        .col-md-3 {
            margin-bottom: 10px;
        }

        label {
            font-weight: 600;
            font-size: 1.1rem;
            /* margin-bottom: 5px; */
            color: black;
            margin-top: 5px;
            text-transform: capitalize;
        }

        .form-control,
        .tox {
            border-radius: 5px !important;
        }

    </style>
@endsection
@section('page-option')
@endsection
@section('s-title')
    <li class="breadcrumb-item">
        {{$data[0]}}
    </li>

@endsection
@section('content')

    <div class="card shadow mb-3">

        <div class="card-body">

            <form action="{{ route('admin.setting.index', ['type' => $type]) }}" method="post" enctype="multipart/form-data"
                id="add-employee">
                @csrf
                <div class="row">

                    @foreach ($data[1] as $item)
                        @php
                            $key=$type.'_'.$item[0];
                        @endphp
                        <div class="col-md-6">
                            <label for="{{$key}}">{{$item[0]}}</label>
                            @if ($item[1]==1)
                            <input type="text" name="{{$key}}" id="{{$key}}" value="{{getSetting($key,true)??''}}" class="form-control" >
                            @elseif($item[1]==0)
                            <input type="file" name="{{$key}}" id="{{$key}}" class="form-control photo" data-default-file="{{asset(getSetting($key,true))}}">
                            @elseif($item[1]==2)
                            <textarea  name="{{$key}}" id="{{$key}}" class="form-control " >{{getSetting($key,true)??''}}</textarea>
                            @endif
                        </div>
                    @endforeach
                </div>
                <div class="py-2">
                    <button class="btn btn-primary">Save {{$data[0]}}</button>
                </div>

            </form>
        </div>
    </div>

@endsection
@section('script')

    <script src="{{ asset('admin/plugins/drophify/js/dropify.min.js') }}"></script>
    <script>

        $(function() {
            $('.photo').dropify();

        });
    </script>
@endsection

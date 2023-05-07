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
        .gmap_canvas,#gmap_canvas{
            height:400px;
            width:100%;
        }
    </style>
@endsection
@section('page-option')
@endsection
@section('s-title')
    <li class="breadcrumb-item">
        About Page
    </li>

@endsection
@section('content')

    <div class="card shadow mb-3">
        <div class="card-body">
            <form action="{{ route('admin.setting.about') }}" method="post" enctype="multipart/form-data"
                id="front-setting">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <label for="main_msg">Message</label>
                        <select name="main_msg" class="form-control" id="main_msg">
                            @foreach ($datas as $data)
                                <option value="{{$data->id}}" {{$data->id==$mainMsg?'selected':''}}>
                                    {{$data->title}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="py-2">
                    <button class="btn btn-primary">Save About Page</button>
                </div>

            </form>
        </div>
    </div>


@endsection
@section('script')


@endsection

@extends('admin.layout.app')
@section('css')
    <style>
        .col-md-3 {
            /* margin-bottom: 10px; */
        }

        label {
            font-weight: 600;
            font-size: 1.1rem;
            /* margin-bottom: 5px; */
            color: black;
            margin-top: 5px;
        }

        .form-control,
        .tox {
            border-radius: 5px !important;
        }

    </style>
@endsection
@section('page-option')
<a href="{{route('admin.service.type.add')}}" class="btn btn-primary">Add New Type</a>

@endsection
@section('s-title')
    <li class="breadcrumb-item active">
        Service Types
    </li>
@endsection
@section('content')


    <div class="bg-white shadow mb-3">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>

                           Name
                        </th>
                        <th>

                            Description
                        </th>

                        <th>

                            Home <br> tiles
                        </th>
                        <th>

                            Home <br> title
                        </th>
                        <th>

                            Home <br> desc
                        </th>
                        <th>

                            Home <br> Image
                        </th>
                        <th>

                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($types as $type)
                        <tr>
                            <td>
                                {{$type->name}}
                            </td>
                            <td>
                                {{$type->desc}}
                            </td>
                            <td>
                                {{$type->home_tiles}}
                            </td>
                            <td>
                                {{$type->home_title}}
                            </td>
                            <td>
                                {{$type->home_desc}}
                            </td>
                            <td>
                                @if ($type->home_image==null)
                                    Image Not Found
                                @else
                                    <img src="{{asset($type->home_image)}}" style="max-width:75px;" alt="">

                                @endif
                            </td>
                            <td>
                                <a class="text-primary" href="{{route('admin.service.type.edit',['type'=>$type->id])}}">
                                    Edit
                                </a>
                                <br>
                                <a class="text-danger" onclick="prompt('Delete {{$type->name}}')=='yes';" href="{{route('admin.service.type.del',['type'=>$type->id])}}">
                                    Del
                                </a>
                                <br>
                                <a href="{{route('admin.service.index',['type'=>$type->id])}}">
                                    Manage
                                </a>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>



@endsection
@section('script')

@endsection

@extends('admin.layout.app')
@section('css')
<link href="{{asset('admin/plugins/DataTables/datatables.min.css')}}" rel="stylesheet">

@endsection
@section('page-option')
<a class="btn btn-primary" href="{{route('admin.service.add',['type'=>$type->id])}}">
   Add New Service
</a>
@endsection
@section('s-title')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.team.type.index') }}">Services</a>
    </li>
    <li class="breadcrumb-item active">
        {{$type->name}}
    </li>


@endsection
@section('content')

<div class="card shadow">
    <div class="card-body">
        <table id="datatable" class="table">
            <thead>
                <tr>
                    <th>REF ID</th>
                    <th>
                        Name
                    </th>
                    <th>
                        Description
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($services as $service)
                    <tr>
                        <td>
                            {{$service->id}}
                        </td>
                        <td>
                            {{$service->name}}
                        </td>
                        <td>
                            {{$service->short_desc}}
                        </td>
                        <td>
                            <a href="{{route('admin.service.edit',['service'=>$service->id])}}" class="btn btn-sm btn-secondary">
                                Edit
                            </a>
                            <a href="{{route('admin.service.del',['service'=>$service->id])}}" onclick="return prompt('Enter yes To Delete Service')=='yes';" class="btn btn-sm btn-danger">
                                del
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
<script src="{{asset('admin/plugins/DataTables/datatables.min.js')}}"></script>
<script>
    var table;
    $(function () {
        table=$('#datatable').DataTable({
            "columnDefs": [
                { "sortable":false,"searchable": false, "targets": 3 }
            ]
        });
    });
</script>
@endsection

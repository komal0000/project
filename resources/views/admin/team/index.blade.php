@extends('admin.layout.app')
@section('css')
<link href="{{asset('admin/plugins/DataTables/datatables.min.css')}}" rel="stylesheet">   

@endsection
@section('page-option')
<a class="btn btn-primary" href="{{route('admin.team.add',['type'=>$type->id])}}">
   Add New Member
</a>
@endsection
@section('s-title')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.team.type.index') }}">Teams</a>
    </li>
    <li class="breadcrumb-item">
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
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($type->getPeople() as $person)
                    <tr>
                        <td>
                            {{$person->id}}
                        </td>
                        <td>
                            {{$person->name}}
                        </td>
                        <td>
                            <a href="{{route('admin.team.edit',['team'=>$person->id])}}" class="btn btn-sm btn-secondary">
                                Edit
                            </a>
                            <a href="{{route('admin.team.del',['team'=>$person->id])}}" onclick="return prompt('Enter yes To Delete Member')=='yes';" class="btn btn-sm btn-danger">
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
                { "sortable":false,"searchable": false, "targets": 2 }
            ]
        });
    });
</script>
@endsection

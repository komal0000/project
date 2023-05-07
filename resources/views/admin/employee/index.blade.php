@extends('admin.layout.app')
@section('css-include')
    <link rel="stylesheet" href="{{asset('admin/plugins/DataTables/datatables.min.css')}}">
@endsection
@section('page-option')
    <a href="{{route('admin.employee.add')}}" class="btn btn-primary">Add Employee</a>
@endsection
@section('s-title')
    <li class="breadcrumb-item active">Employees</li>
@endsection
@section('content')
    @php
        $type=def('emp_type');
    @endphp
    <div class="card shadow mb-3">
        <div class="card-body">
            <table class="table " id="datatable">
                <thead>
                    <tr>
                        <th>
                            Name
                        </th>
                        <th>
                            Email
                        </th>
                        <th>
                            Phone
                        </th>
                        <th>
                            Designation
                        </th>
                        <th>
                            Type
                        </th>
                        <th>

                        </th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($employees as $employee)
                        <tr id="emp-{{$employee->id}}">
                            <td>
                                {{$employee->name}}
                            </td>
                            <td>
                                {{$employee->email}}
                            </td>
                            <td>
                                {{$employee->phone_no}}
                            </td>
                            <td>
                                {{$employee->designation}}
                            </td>
                            <td>
                                {{$type[$employee->type]}}
                            </td>
                            <td>
                                <a class="btn btn-table text-success" href="{{route('admin.employee.update',['employee'=>$employee->id])}}"><i class="material-icons">edit</i></a>
                                <span class="btn btn-table  text-danger" onclick="del({{$employee->id}})"><i class="material-icons">delete</i></span>
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
                    { "sortable":false,"searchable": false, "targets": 5 }
                ]
            });
        });
        function del(id){
            if(confirm('Do You Want to Delete Employee?')){
                $('body').block();
                axios.post('{{route('admin.employee.delete')}}',{id:id})
                .then((res)=>{
                    if(res.data.status){
                        table
                        .row( $('#employee-'+id).parents('tr') )
                        .remove()
                        .draw();
                        toastr.success('Employee Deleted SucessFully');
                    }else{
                        toastr.error('Employee Cannot Be Deleted, '+res.data.message);
                    }
                    $('body').unblock();

                })
                .catch((err)=>{
                    toastr.error('Academic Year Could Not Be Deleted.Please Try Again.');
                    $('body').unblock();
                });
            }
        }
    </script>
@endsection

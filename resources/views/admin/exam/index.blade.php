@extends('admin.layout.app')
@section('css-include')
    <link rel="stylesheet" href="{{asset('admin/plugins/DataTables/datatables.min.css')}}">
@endsection
@section('page-option')
    <a href="{{route('admin.exam.add')}}" class="btn btn-primary">Add Exam</a>
@endsection
@section('s-title')
    <li class="breadcrumb-item active">Exam</li>
@endsection
@section('content')
  
    <div class="card shadow mb-3 exam-holder" >
        <div class="card-body">
            <table class="table " id="datatable">
                <thead>
                    <tr>
                        <th>
                            Name
                        </th>
                        <th>
                            Academic Year
                        </th>
                        <th>
                            Start Date
                        </th>
                        <th>
                            End Date
                        </th>
                       
                        <th>

                        </th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($exams as $exam)
                        <tr id="exam-{{$exam->id}}">
                            <td>
                                {{$exam->name}}
                            </td>
                            <td>
                                {{$exam->ac}}
                            </td>
                            <td>
                                {{$exam->start}}
                            </td>
                            <td>
                                {{$exam->end}}
                            </td>
                         
                            <td>
                                <a class="btn btn-table text-success" href="{{route('admin.exam.update',['exam'=>$exam->id])}}"><i class="material-icons">edit</i></a>
                                <span class="btn btn-table  text-danger" onclick="del({{$exam->id}})"><i class="material-icons">delete</i></span>
                                <a class="btn btn-table text-success" href="{{route('admin.exam.info',['id'=>$exam->id])}}"><i class="material-icons">visibility</i></a>
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
                    { "sortable":false,"searchable": false, "targets": 4}
                ]
            });
        });
        function del(id){
            if(confirm('Do You Want to Delete Exam?')){
                block('#exam-holder');
                axios.post('{{route('admin.exam.delete')}}',{id:id})
                .then((res)=>{
                    if(res.data.status){
                        table
                        .row( $('#exam-'+id).parents('tr') )
                        .remove()
                        .draw();
                        toastr.success('Exam Deleted SucessFully');
                    }else{
                        toastr.error('Exam Cannot Be Deleted, '+res.data.message);
                    }
                    unblock('#exam-holder');


                })
                .catch((err)=>{
                    toastr.error('Exam Could Not Be Deleted.Please Try Again.');
                    unblock('#exam-holder');
                });
            }
        }
    </script>
@endsection

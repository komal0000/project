@extends('admin.layout.app')
@section('css-include')
    <link rel="stylesheet" href="{{asset('admin/plugins/DataTables/datatables.min.css')}}">
@endsection
@section('page-option')
    <a href="{{route('admin.student.add')}}" class="btn btn-primary">Add Student</a>
@endsection
@section('s-title')
    <li class="breadcrumb-item active">Students</li>
    <li class="breadcrumb-item active">Assements</li>
@endsection
@section('content')
<script>
    _data={!! json_encode($data,true) !!};
    data=getData(_data);
</script>

@include('admin.student.assessment.edit')
<div class="card shadow mb-3">
    <div class="card-body">
        <form action="{{route('admin.assessment.add')}}" method="post" id="add-assessment">
            @csrf
            <div class="row">
                <div class="col-md-5">
                    <label for="academic_year_id">Academic Year</label>
                    <select class="form-control" name="academic_year_id" id="academic_year_id">
                        <script>
                            document.write(getOptions(data.academic_years));
                        </script>
                    </select>
                </div>
                <div class="col-md-7">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="col-md-3 d-flex align-items-end py-1">
                    <button class="btn btn-primary" >Save Assesment</button>
                </div>
            </div>
        </form>
      
       
    </div>
</div>


<div class="card shadow">
    <div class="card-body">
        <table id="datatable" class="table">
            <thead>
                <tr>
                    <th>
                        #CODE
                    </th>
                    <th>
                        Academic Year
                    </th>
                    <th>
                        Assessment Title
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($assessments as $assessment)
                    <tr id="assessment-{{$assessment->id}}">
                        <td>
                            {{$assessment->id}}
                        </td>
                        <td>
                            {{$assessment->title}}
                        </td>
                        <td>
                            {{$assessment->name}}
                        </td>
                        <td>
                            <a class="btn btn-sm btn-primary mr-2" href='{{route('admin.assessment.manage')}}?id={{$assessment->id}}'>Manage<a>
                            <button class="btn btn-sm btn-success mr-2" onclick="initEdit({{$assessment->id}},'{{$assessment->name}}',{{$assessment->academic_year_id}})">Edit</button>
                            <button class="btn btn-sm btn-danger" onclick="del({{$assessment->id}})">Delete</button>
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

            $('#add-assessment').submit(function (e) { 
                e.preventDefault();
                add(this);
            });

            $('#edit-assessment').submit(function (e) { 
                e.preventDefault();
                edit(this);
            });
        });

        function edit(ele) {
            let fd=new FormData(ele);
            axios.post($(ele).attr('action'),fd)
            .then((res)=>{
                ele.reset();
                $('#edit-assessment-modal').modal('hide');

                const ay=(data.academic_years.filter(o=>o[0]==res.data.academic_year_id))[0][1];
                console.log(ay);
                table.row('#assessment-'+res.data.id).data(
                [
                    res.data.id,
                    ay,
                    res.data.name,
                    "<a class='btn btn-sm btn-primary mr-2' href='{{route('admin.assessment.manage')}}?id="+res.data.id+"'>Manage<a>"+
                    '<button class="btn btn-sm btn-success mr-2" onclick="initEdit('+res.data.id+',\''+res.data.name+'\','+res.data.academic_year_id+')">Edit</button>'+
                    '<button class="btn btn-sm btn-danger" onclick="del('+res.data.id+')">Delete</button>'
                ]
                );
                table.draw(false);
            })
            .catch((err)=>{
                console.log(err);
            });
            // table.row.add( [
            //     'adfasdf','ll','<a href="asdfas">kk</a>'
            // ]).draw();
        }

        function add(ele) {
            let fd=new FormData(ele);
            axios.post($(ele).attr('action'),fd)
            .then((res)=>{
                ele.reset();
                const ay=(data.academic_years.filter(o=>o[0]==res.data.academic_year_id))[0][1];
                console.log(ay);
                table.row.add(
                [
                    res.data.id,
                    ay,
                    res.data.name,
                    "<a class='btn btn-sm btn-primary mr-2' href='{{route('admin.assessment.manage')}}?id="+res.data.id+"'>Manage<a>"+
                    '<button class="btn btn-sm btn-success mr-2" onclick="initEdit('+res.data.id+',\''+res.data.name+'\','+res.data.academic_year_id+')">Edit</button>'+
                    '<button class="btn btn-sm btn-danger" onclick="del('+res.data.id+')">Delete</button>'
                ]
                ).node().id = 'assessment-'+res.data.id;
                table.draw(false);
                toastr.success('Assessment Updated Sucessfully');
            })
            .catch((err)=>{
                console.log(err);
                toastr.error('Assessment Not Updated.');

            });
            // table.row.add( [
            //     'adfasdf','ll','<a href="asdfas">kk</a>'
            // ]).draw();
        }

        function initEdit(id,name,ay_id) {
            console.log(id,name,ay_id);
                $('#edit-assessment-modal').modal('show');
                $('#eid').val(id);
                $('#ename').val(name);
                $('#eacademic_year_id').val(ay_id);
        }   

        function del(id) {
            if(confirm('Do You want To Delete Assesment?')){
                axios.post('{{route('admin.assessment.del')}}',{id:id})
                .then((res)=>{
                    table.row('#assessment-'+id).remove().draw();
                    toastr.success('Assessment Deleted Sucessfully');
                })
                .catch((err)=>{
                    console.log(err);
                    toastr.error('Assessment Not deleted.');

                });
            }
        }
    </script>
@endsection

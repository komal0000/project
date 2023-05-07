@extends('admin.layout.app')
@section('css-include')

@endsection
@section('page-option')

@endsection
@section('s-title')
    <li class="breadcrumb-item">Setting</li>
    <li class="breadcrumb-item"><a href="{{route('admin.setting.level.index')}}">{{env('iscollage',false)?"Program":"Level"}}</a> </li>
    <li class="breadcrumb-item">{{$level->title}}</li>
    <li class="breadcrumb-item active">{{env('iscollage',false)?"Semester":"Section"}}</li>
@endsection
@section('content')
    <div class="card shadow mb-3">
        <div class="card-body">
            <form action="{{route('admin.setting.level.sectionAdd')}}" method="post">
                @csrf
                <input type="hidden" name="level_id" value="{{$level->id}}">

                <div class="row">
                    <div class="col-md-6">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="title">{{env('iscollage',false)?"Program Head":"Class Teacher"}}</label>
                        <select name="employee_id" id="employee_id" class="form-control">
                            <option value="-1">--Select {{env('iscollage',false)?"Program Head":"Class Teacher"}}--</option>
                            @foreach ($employees as $employee)
                            <option value="{{$employee->id}}">{{$employee->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 py-2">
                        <button class="btn btn-primary">Add {{env('iscollage',false)?"Semester":"Section"}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card shadow ">
        <div class="card-body">
            @foreach ($level->sections as $section)
            <div class="card shadow mb-3" id="section-{{$section->id}}">
                <div class="card-body">
                    <form action="{{route('admin.setting.level.sectionUpdate')}}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$section->id}}">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control" required value="{{$section->title}}">
                            </div>
                            <div class="col-md-3">
                                <label for="title">{{env('iscollage',false)?"Semester Head":"Class Teacher"}}</label>
                                <select name="employee_id" id="employee_id" class="form-control">
                                    <option value="-1">--Select {{env('iscollage',false)?"Semester Head":"Class Teacher"}}--</option>
                                    @foreach ($employees as $employee)
                                    <option value="{{$employee->id}}" {{$section->employee_id==$employee->id?'selected':''}}>{{$employee->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 pt-4">
                                <div class="mt-2">

                                    <button class="btn btn-primary">Update {{env('iscollage',false)?"Semester":"Section"}}</button>
                                    <span class="btn btn-danger" onclick="del({{$section->id}})">Delete {{env('iscollage',false)?"Semester":"Section"}}</span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
@section('script')
    <script>
        function del(id){
            if(confirm('Do You Want to Delete {{env('iscollage',false)?"Semester":"Section"}}?')){
                $('body').block();
                axios.post('{{route('admin.setting.level.sectionDelete')}}',{id:id})
                .then((res)=>{
                    if(res.data.status){
                        $('#section-'+id).remove();
                        toastr.success('{{env('iscollage',false)?"Semester":"Section"}} Deleted SucessFully');
                    }else{
                        toastr.error('{{env('iscollage',false)?"Semester":"Section"}} Cannot Be Deleted, '+res.data.message);
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

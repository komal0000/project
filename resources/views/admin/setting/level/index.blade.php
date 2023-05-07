@extends('admin.layout.app')
@section('css-include')

@endsection
@section('page-option')

@endsection
@section('s-title')
    <li class="breadcrumb-item">Setting</li>
    <li class="breadcrumb-item"> {{env('iscollage',false)?"Program":"Level"}} </li>
@endsection
@section('content')
    <div class="card shadow mb-3">
        <div class="card-body">
            <form action="{{route('admin.setting.level.add')}}" method="post">
                @csrf
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
                        <button class="btn btn-primary">Add {{env('iscollage',false)?"Program":"Level"}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card shadow ">
        <div class="card-body">
            @foreach ($levels as $level)
            <div class="card shadow mb-3" id="level-{{$level->id}}">
                <div class="card-body">
                    <form action="{{route('admin.setting.level.update')}}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$level->id}}">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control" required value="{{$level->title}}">
                            </div>
                            <div class="col-md-3">
                                <label for="title">{{env('iscollage',false)?"Program Head":"Class Teacher"}}</label>
                                <select name="employee_id" id="employee_id" class="form-control">
                                    <option value="-1">--Select {{env('iscollage',false)?"Program Head":"Class Teacher"}}--</option>
                                    @foreach ($employees as $employee)
                                    <option value="{{$employee->id}}" {{$level->employee_id==$employee->id?'selected':''}}>{{$employee->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 pt-4">
                                <div class="mt-2">

                                    <button class="btn btn-primary">Update {{env('iscollage',false)?"Program":"Level"}}</button>
                                    <span class="btn btn-danger" onclick="del({{$level->id}})">Delete Level</span>
                                    <a class="btn btn-success" href="{{route('admin.setting.level.section',['level'=>$level->id])}}">{{env('iscollage',false)?"Semesters":"Sections"}}</a>
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
            if(confirm('Do You Want to Delete Level?')){
                $('body').block();
                axios.post('{{route('admin.setting.level.delete')}}',{id:id})
                .then((res)=>{
                    if(res.data.status){
                        $('#level-'+id).remove();
                        toastr.success('Level Deleted SucessFully');
                    }else{
                        toastr.error('Level Cannot Be Deleted, '+res.data.message);
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

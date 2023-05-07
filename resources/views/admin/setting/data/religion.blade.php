@extends('admin.layout.app')
@section('css-include')

@endsection
@section('page-option')
@endsection
@section('s-title')
    <li class="breadcrumb-item">Setting</li>
    <li class="breadcrumb-item">Data</li>
    <li class="breadcrumb-item">Religions</li>
@endsection
@section('content')
    <div class="card shadow">
        <div class="card-body">
            <form action="" method="post">
                @csrf
                <input type="hidden" name="type" value="1">
                <div class="row">
                    <div class="col-md-9">
                        <label for="name">Religion Name</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button class="btn btn-primary">
                            Add Religion 
                        </button>
                    </div>
                </div>
             
            </form>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <div class="row">
                <div class="col-md-7">
                    <h6>Religion Name</h6>
                </div>
                
            </div>
            @foreach ($data as $religion)
            <div id="religion-{{$religion->id}}">
                <hr>
                <form action="" method="post">
                    @csrf
                    <input type="hidden" name="type" value="2">
                    <input type="hidden" name="id" value="{{$religion->id}}">
                    <div class="row">
                        <div class="col-md-7">
                            <input type="text" name="name" id="name" class="form-control" value="{{$religion->name}}">
                        </div>
                        <div class="col-md-5 ">

                            <button class="btn btn-primary">
                                Update Religion 
                            </button>
                            <span class="btn btn-danger" onclick="del({{$religion->id}},'{{$religion->name}}')">Delete</span>
                        </div>
                    </div>
                 
                </form>
            </div>
            @endforeach
        </div>
    </div>


@endsection
@section('script')
    <script>
        function del(id,name) {
            if(confirm('Do You Want To Delete '+name+' Religion?')){
                axios.post('{{route('admin.setting.religion')}}',{"id":id,"type":3})
                .then((res)=>{
                    if(res.data=='ok'){
                        $('#religion-'+id).remove();
                        toastr.success(name+' Religion Deleted Sucessfully');
                    }else{
                        toastr.error(name+' Religion Cannot be Deleted');

                    }
                })
                .catch((err)=>{
                    toastr.error(name+' Religion Cannot be Deleted');
                });
            }
        }
    </script>
@endsection

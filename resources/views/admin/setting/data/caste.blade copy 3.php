@extends('admin.layout.app')
@section('css-include')

@endsection
@section('page-option')
@endsection
@section('s-title')
    <li class="breadcrumb-item">Setting</li>
    <li class="breadcrumb-item">Data</li>
    <li class="breadcrumb-item">Caste</li>
@endsection
@section('content')
    <div class="card shadow">
        <div class="card-body">
            <form action="" method="post">
                @csrf
                <input type="hidden" name="type" value="1">
                <div class="row">
                    <div class="col-md-9">
                        <label for="caste">Caste Name</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button class="btn btn-primary">
                            Add Caste 
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
                    <h6>Caste Name</h6>
                </div>
                
            </div>
            @foreach ($data as $caste)
            <div id="caste-{{$caste->id}}">
                <hr>
                <form action="" method="post">
                    @csrf
                    <input type="hidden" name="type" value="2">
                    <input type="hidden" name="id" value="{{$caste->id}}">
                    <div class="row">
                        <div class="col-md-7">
                            <input type="text" name="name" id="name" class="form-control" value="{{$caste->name}}">
                        </div>
                        <div class="col-md-5 ">

                            <button class="btn btn-primary">
                                Update Caste 
                            </button>
                            <span class="btn btn-danger" onclick="del({{$caste->id}},'{{$caste->name}}')">Delete</span>
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
            if(confirm('Do You Want To Delete '+name+' Caste?')){
                axios.post('{{route('admin.setting.caste')}}',{"id":id,"type":3})
                .then((res)=>{
                    if(res.data=='ok'){
                        $('#caste-'+id).remove();
                        toastr.success(name+' Caste Deleted Sucessfully');
                    }else{
                        toastr.error(name+' Caste Cannot be Deleted');

                    }
                })
                .catch((err)=>{
                    toastr.error(name+' Caste Cannot be Deleted');
                });
            }
        }
    </script>
@endsection

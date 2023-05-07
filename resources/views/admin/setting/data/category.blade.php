@extends('admin.layout.app')
@section('css-include')

@endsection
@section('page-option')
@endsection
@section('s-title')
    <li class="breadcrumb-item">Setting</li>
    <li class="breadcrumb-item">Data</li>
    <li class="breadcrumb-item">Category</li>
@endsection
@section('content')
    <div class="card shadow">
        <div class="card-body">
            <form action="" method="post">
                @csrf
                <input type="hidden" name="type" value="1">
                <div class="row">
                    <div class="col-md-3">
                        <label for="name"> Name</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="col-md-7">
                        <label for="desc"> Description</label>
                        <input type="text" name="desc" id="desc" class="form-control">
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <div>
                            <input type="checkbox" name="reserved" id="reserved" value="1"> <label for="reserved">Reserved</label>
                            <button class="btn btn-primary">
                                Add Category 
                            </button>
                        </div>
                    </div>
                </div>
             
            </form>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <h6>Name</h6>
                </div>
                <div class="col-md-7">
                    <h6>Description</h6>
                </div>
                <div class="col-md-2">
                    <h6>Reserved</h6>
                </div>
                
            </div>
            @foreach ($data as $category)
            <div id="category-{{$category->id}}">
                <hr>
                <form action="" method="post">
                    @csrf
                    <input type="hidden" name="type" value="2">
                    <input type="hidden" name="id" value="{{$category->id}}">
                    <div class="row">
                        <div class="col-md-3">
                            <input type="text" name="name" id="name" class="form-control" value="{{$category->name}}">
                        </div>
                        <div class="col-md-7">
                            <input type="text" name="desc" id="desc" class="form-control" value="{{$category->desc}}">
                        </div>
                        <div class="col-md-2">
                            <input type="checkbox" name="reserved" id="reserved" value="1" {{$category->reserved?'checked':''}}> <label for="reserved">Reserved</label>
                        </div>
                        <div class="col-md-6 pt-3">
                            
                            <button class="btn btn-primary">
                                Update category 
                            </button>
                            <span class="btn btn-danger" onclick="del({{$category->id}},'{{$category->name}}')">Delete</span>
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
            if(confirm('Do You Want To Delete '+name+' Category?')){
                axios.post('{{route('admin.setting.category')}}',{"id":id,"type":3})
                .then((res)=>{
                    if(res.data=='ok'){
                        $('#category-'+id).remove();
                        toastr.success(name+' Category Deleted Sucessfully');
                    }else{
                        toastr.error(name+' Category Cannot be Deleted');

                    }
                })
                .catch((err)=>{
                    toastr.error(name+' Category Cannot be Deleted');
                });
            }
        }
    </script>
@endsection

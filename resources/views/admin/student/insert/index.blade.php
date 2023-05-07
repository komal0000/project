@extends('admin.layout.app')
@section('css')
<style>
    .col-md-3{
        margin-bottom:10px;
    }
    .no-change{
        margin-right:5px;
    }

    .form-control{
        padding: 0.375rem 0.75rem !important;
    }
</style>
@endsection
@section('page-option')
@endsection
@section('s-title')
    <li class="breadcrumb-item">
        <a href="{{route('admin.student.index')}}">Students</a>
    </li>
    <li class="breadcrumb-item active">
        Mass Insert 
    </li>
@endsection
@section('content')
   

    <div class="card shadow mb-3">
        <div class="card-body">
           <form action="{{route('admin.student.massinsert')}}" id="add-student" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  
                    
                    <div class="col-md-12">
                        <label for="file">  File</label>
                        <input type="file" accept=".csv" name="file" id="file" class="form-control">
                    </div>
                  
                 
        
                    <div class="col-md-12">
                        <hr>
                        <button class="btn btn-primary">Load Student</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('script')

@endsection

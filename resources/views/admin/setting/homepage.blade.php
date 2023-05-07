@extends('admin.layout.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/drophify/css/dropify.min.css') }}">
    <style>
        .col-md-3 {
            margin-bottom: 10px;
        }

        label {
            font-weight: 600;
            font-size: 1.1rem;
            /* margin-bottom: 5px; */
            color: black;
            margin-top: 5px;
            text-transform: capitalize;
        }

        .form-control,
        .tox {
            border-radius: 5px !important;
        }

    </style>
@endsection
@section('page-option')
@endsection
@section('s-title')
    <li class="breadcrumb-item">
        Home Page Setting
    </li>
    
@endsection
@section('content')

    <div class="card shadow mb-3">
        <div class="card-body">
            <form action="{{ route('admin.setting.homepage') }}" method="post" enctype="multipart/form-data"
                id="front-setting">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <label for="program">Program Summary</label>
                        <textarea name="program" id="program"  class="form-control" required>{{$data->program}}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label for="why">Why Us Summary</label>
                        <textarea name="why" id="why"  class="form-control" required>{{$data->why}}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label for="event">Upcomming Events Summary</label>
                        <textarea name="event" id="event"  class="form-control" required>{{$data->event}}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label for="news">Lastest news Summary</label>
                        <textarea name="news" id="news"  class="form-control" required>{{$data->news}}</textarea>
                    </div>
                    @php
                        
                        $about_title=[];
                        if(isset($data->about_title)){
                            $about_title=(array)($data->about_title);
                        }
                    @endphp
                    @foreach ($abouts as $about)
                        <div class="col-md-6 py-2">
                            <input type="checkbox" name="about[]" id="about-{{$about->id}}" {{in_array($about->id,$data->about)?'checked':''}} value="{{$about->id}}">
                            <label for="about-{{$about->id}}">{{$about->title}}</label> 
                            @php
                                $value=$about->title;
                                    if(in_array($about->id,$data->about)){
                                        $abt=$about_title['about_'.$about->id];
                                        if(isset($abt)){
                                            $value=$abt->title;
                                        } 
                                    }
                            @endphp
                            <input type="text" name="about_{{$about->id}}" value="{{$value}}" id="about_{{$about->id}}" class="form-control">
                        </div>
                    @endforeach
                   
                </div>
                <div class="py-2">
                    <button class="btn btn-primary">Save Home Page Setting</button>
                </div>
                
            </form>
        </div>
    </div>

@endsection
@section('script')
  
    <script src="{{ asset('admin/plugins/drophify/js/dropify.min.js') }}"></script>
    <script>
     
        $(function() {
            $('.photo').dropify();
            
        });
    </script>
@endsection

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

        .gmap_canvas,#gmap_canvas{
            height:400px;
            width:100%;
        }
    </style>
@endsection
@section('page-option')
@endsection
@section('s-title')
    <li class="breadcrumb-item">
        Footer 
    </li>
    
@endsection
@section('content')

    <div class="card shadow mb-3">
        <div class="card-body">
            <form action="{{ route('admin.setting.footer.index') }}" method="post" enctype="multipart/form-data"
                id="add-employee">
                @csrf
                <div class="shadow mb-3">
                    <h4 class="p-3">
                        About Footer 
                    </h4>
                    <hr class="m-0">
                    <div class="card-body">
                        <div>
                            <label for="title">title</label>
                            <input type="text" name="title" id="title" value="{{$footer1->title}}" class="form-control" required>
                        </div>
                        <div>
                            <label for="desc">Description</label>
                            <textarea type="text" name="desc" id="desc" value="{{$footer1->title}}" class="form-control" required>{{$footer1->desc}}</textarea>
                        </div>
                        <div class="pt-3">
                            <div class="shadow ">
                                <h6 class="d-flex justify-content-between align-items-center px-3 py-1">
                                    <span>
                                        About Links 
                                    </span>
                                    <span class="btn" onclick="add('footer1');">
                                        Add Link
                                    </span>
                                </h6>
                                <hr class="m-0">
                                <div class="card-body" id="footer1">
                                    <div class="row m-0">
                                        <div class="row col-md-4 ps-4"> <strong>Title</strong> </div>
                                        <div class="row col-md-5 px-4"> <strong>Link</strong></div>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="shadow mb-3">
                    <h4 class="d-flex justify-content-between align-items-center px-3 py-1">
                        <span>
                            Quick Links 
                        </span>
                        <span class="btn" onclick="add('footer2');">
                            Add Link
                        </span>
                    </h4>
                    <hr class="m-0">
                    <div class="card-body" id="footer2">
                        <div class="row m-0">
                            <div class="row col-md-4 ps-4"> <strong>Title</strong> </div>
                            <div class="row col-md-5 px-4"> <strong>Link</strong></div>
                        </div>
                        <hr>
                    </div>
                </div>
                <div class="shadow mb-3">
                    <h4 class="d-flex justify-content-between align-items-center px-3 py-1">
                        <span>
                            Important Links 
                        </span>
                        <span class="btn" onclick="add('footer3');">
                            Add Link
                        </span>
                    </h4>
                    <hr class="m-0">
                    <div class="card-body" id="footer3">
                        <div class="row m-0">
                            <div class="row col-md-4 ps-4"> <strong>Title</strong> </div>
                            <div class="row col-md-5 px-4"> <strong>Link</strong></div>
                        </div>
                        <hr>
                    </div>
                </div>
                <div class="shadow mb-3">
                    <h4 class="d-flex justify-content-between align-items-center px-3 py-1">
                        <span>
                            Map
                        </span>
                        <input type="text" id="footer4" name="footer4" class="form-control w-25" placeholder="Search Place" value="{{$footer4}}">
                    </h4>
                    <hr class="m-0">
                    <div class="card-body d-flex justify-content-center" id="footer-4">
                        <div style="width: 400px;">
                            <div class="gmap_canvas">
                                <iframe  id="gmap_canvas"
                                src="" frameborder="0"
                                scrolling="no" marginheight="0" marginwidth="0"></iframe>
                              </div>
                        </div>
                    </div>
                </div>
                <div class="py-2">
                    <button class="btn btn-primary">Save Footer</button>
                </div>
                
            </form>
        </div>
    </div>

    <div id="link-template" class="d-none">
        <div class="row" id="link_xxx_id">
            <input type="hidden" name="xxx_type[]" value="xxx_id">
            
            <div class="col-md-4">
                <input type="text" value="xxx_title" name="title_xxx_id" required class="form-control">
            </div>
            <div class="col-md-5">
                <input type="text" value="xxx_link" name="link_xxx_id" required class="form-control">
            </div>
            <div class="col-md-3">
                <button class="btn btn-danger w-100" onclick="del(xxx_id)">Del</button>
            </div>
        </div>
        <hr>
    </div>
@endsection
@section('script')
    
    <script src="{{ asset('admin/plugins/drophify/js/dropify.min.js') }}"></script>

    <script>
        const mapurl="https://maps.google.com/maps?q=xxx_map&t=&z=13&ie=UTF8&iwloc=&output=embed";
        const footer1={!! json_encode($footer1->links) !!};
        const footer2={!! json_encode($footer2) !!};
        const footer3={!! json_encode($footer3) !!};
        const footer4="{{$footer4}}";
        const tem=$('#link-template').html();
        $('#link-template').remove();
        var i=1;
        $(function() {
            $('.photo').dropify();
            footer1.forEach(f => {
                $('#footer1').append(strReplaceAll(tem,['xxx_id','xxx_title','xxx_link','xxx_type'],[i,f.title,f.link,'footer1']));
                i+=1;
            });
            footer2.forEach(f => {
                $('#footer2').append(strReplaceAll(tem,['xxx_id','xxx_title','xxx_link','xxx_type'],[i,f.title,f.link,'footer2']));
                i+=1;
            });
            footer3.forEach(f => {
                $('#footer3').append(strReplaceAll(tem,['xxx_id','xxx_title','xxx_link','xxx_type'],[i,f.title,f.link,'footer3']));
                i+=1;
            });

            $('#footer4').keydown(function (e) { 
                if(e.which==13){
                    e.preventDefault();
                    setMap(this.value);
                }
            });

            if(footer4.length>0){
                setMap(footer4);
            }

        });

        function add(type){
            $('#'+type).append(strReplaceAll(tem,['xxx_id','xxx_title','xxx_link','xxx_type'],[i,'','',type]));
            i+=1;
        }
        function  del(id) {
            $('#link_'+id).remove();
        }
        function setMap(params) {
            $('#gmap_canvas').attr('src',mapurl.replace('xxx_map',params));
        }
    </script>
@endsection

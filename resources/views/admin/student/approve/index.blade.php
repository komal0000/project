@extends('admin.layout.app')
@section('css')
    <style>
        .col-md-3 {
            margin-bottom: 10px;
        }

        .no-change {
            margin-right: 5px;
        }

        .form-control {
            padding: 0.375rem 0.75rem !important;
            border-radius: 5px;
        }

        .nav-tabs .nav-link {
            border: none;
            background: white;
            border-bottom: 1px solid rgb(214, 214, 214);
            ;
            outline: none;
            border-radius: 0px !important;
        }

        .nav-tabs .nav-link.active {
            border: none;
            color: #fff;
            background: linear-gradient(90deg, #55c3b7 0, #5fd0a5 48%, #66da90 100%);
            border-bottom: none;
        }

        .nav-tabs {
            margin-bottom: 0px;
        }

        .tab-content {
            border: 1px solid rgb(214, 214, 214);
            border-top: none;
            padding: 15px;

        }

    </style>
@endsection
@section('page-option')
@endsection
@section('s-title')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.student.index') }}">Students</a>
    </li>
    <li class="breadcrumb-item active">
        Mass Insert
    </li>
    <li class="breadcrumb-item active">
        Approve
    </li>
@endsection
@section('content')
    <script>
        _data = {!! json_encode($data, true) !!};
        data = getData(_data);
    </script>
    @php
    $arr = ['Pending', 'Approved', 'Reject'];
    @endphp
    <div class="card shadow mb-3">
        <div class="card-body">
            <form action="{{ route('admin.student.approve') }}" id="load-student" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <label for="l_id">{{ env('iscollage', false) ? 'Program' : 'Level' }}</label>
                        <select class="form-control" name="l_id" id="l_id" onchange="selectSection(this);">
                            <script>
                                document.write(getOptions(data.levels));
                            </script>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="s_id">{{ env('iscollage', false) ? 'Semester' : 'Section' }}</label>
                        <select class="form-control" name="s_id" id="s_id">

                        </select>
                    </div>
                    {{-- <div class="col-md-3">
                        <label for="type">Type</label> 
                        <div>
                            <input type="checkbox" name="type[]" value="0"> Pending 
                            <input type="checkbox" name="type[]" value="1"> Approved 
                            <input type="checkbox" name="type[]" value="2"> Rejected 
                        </div>
                        
                    </div> --}}

                    <div class="col-md-3 pt-4">

                        <button class="btn btn-primary">Load Student</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow d-none " id="data-holder">
        <div class="card-body">
            <ul class="nav nav-tabs d-flex " id="myTab" role="tablist">
                @for ($i = 0; $i < 3; $i++)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{ $i == 0 ? 'active' : '' }}" id="data-{{ $i }}-tab" data-toggle="tab"
                            data-target="#data-{{ $i }}" type="button" role="tab" aria-controls="home"
                            aria-selected="true">{{ $arr[$i] }}</button>
                    </li>
                @endfor

            </ul>

            <div class="tab-content" id="myTabContent">
                @for ($i = 0; $i < 3; $i++)
                    <div class="tab-pane fade  {{ $i == 0 ? 'show active' : '' }}" id="data-{{ $i }}" role="tabpanel"
                        aria-labelledby="home-tab">{{ $i }}</div>
                @endfor

            </div>
        </div>
    </div>

    <span class="d-none" id="template">
        <div id="std-xxx_id">
            <div class="row" >
                <div class="col-md-2">
                    <img src="xxx_src" alt="" class="w-100">
                </div>
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-3">
                            <strong>Name</strong>
                            <div>xxx_name</div>
                        </div>
                        <div class="col-md-3">
                            <strong>Email</strong>
                            <div>xxx_email</div>
                        </div>
                        <div class="col-md-3">
                            <strong>Phome</strong>
                            <div>xxx_phone</div>
                        </div>
                        <div class="col-md-3">
                            <strong>Address</strong>
                            <div>xxx_addr</div>
                        </div>
                    </div>
                    <hr class="my-1">
                    <div id="approve-xxx_id" >
                        <button  class="btn btn-danger" onclick="reject(xxx_id)">Reject</button>
                        <button class="btn btn-success" onclick="accept(xxx_id)">Approve</button>
                    </div>
                </div>
            </div>
            <hr>
        </div>
    </span>
@endsection
@section('script')
    <script>
        var template;
        $(function() {
            template = $('#template').html();
            console.log(template);
            selectSection(1);
            $('#load-student').submit(function(e) {
                e.preventDefault();
                loadData(this);
            });
        });

        function loadData(ele) {
            $('#data-holder').addClass('d-none');
            $('#data-1').html('');
            $('#data-2').html('');
            $('#data-0').html('');
            axios.post(ele.action, new FormData(ele))
                .then((res) => {


                    res.data.students.forEach(std => {
                        html = strReplaceAll(template,
                            ['xxx_src', 'xxx_name', 'xxx_email', 'xxx_phone', 'xxx_addr', 'xxx_approved',
                                'xxx_id'
                            ],
                            ['/' + std.photo, std.name, std.email, std.phone, std.block, std.confirmed, std
                                .id
                            ]
                        );
                        $('#data-' + std.confirmed).append(html);
                        
                    });

                    $('#data-holder').removeClass('d-none');

                })
                .catch((err) => {
                    console.log(err);
                });
        }

        function reject(id) {
            if (confirm('Do You Want To Reject Student')) {
                axios.post("{{ route('admin.student.reject') }}", {
                        "id": id
                    })
                    .then((res) => {
                        console.log();(res.data);
                        if (res.data.status) {
                            $('#std-'+id).appendTo('#data-2');
                            
                        } else {
                            error('Please try again');
                        }
                    })
                    .catch((err) => {

                    });
            }
        }

        function accept(id) {
            if (confirm('Do You Want To Accept Student')) {
                axios.post("{{ route('admin.student.accept') }}", {
                        "id": id
                    })
                    .then((res) => {
                        if (res.data.status) {
                            $('#std-'+id).appendTo('#data-1');  
                        } else {
                            error('Please try again');
                        }
                    })
                    .catch((err) => {

                    });
            }
        }


        function selectSection(ele) {
            $('#s_id').html(getOptions(anotherSelect(data.sections, $('#l_id').val(), 1), 2));
        }
    </script>
@endsection

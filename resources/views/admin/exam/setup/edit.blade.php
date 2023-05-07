@extends('admin.layout.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/drophify/css/dropify.min.css') }}">
    <style>
        .col-md-3 {
            margin-bottom: 10px;
        }

        .no-change {
            margin-right: 5px;
        }

        .table td,
        .table th {
            padding: 5px !important;
        }

        .w-15 {
            width: 15%;
        }

        .w-25 {
            width: 30%;
        }

        .w-45 {
            width: 45%;
        }

        table tr:first-child th {
            border: none !important;
        }

        /* .form-control{
                padding: 0.375rem 0.75rem !important;
            } */

    </style>
@endsection
@section('page-option')
@endsection
@section('s-title')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.exam.index') }}">Exams</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('admin.exam.info', ['id' => $subject->exam->id]) }}">{{ $subject->exam->name }}</a>
    </li>
    <li class="breadcrumb-item ">
        <a href="{{ route('admin.exam.subject.index', ['exam' => $subject->exam->id]) }}">Subects</a>
    </li>
    <li class="breadcrumb-item ">
        {{ $subject->level->title }}
    </li>
    @if ($subject->section != null)
        <li class="breadcrumb-item ">
            {{ $subject->section->title }}
        </li>
    @endif
    <li class="breadcrumb-item ">
        {{ $subject->name }}
    </li>
    <li class="breadcrumb-item ">
        Edit
    </li>
@endsection
@section('content')

    @include('admin.exam.setup.template')
    <div class="bg-white shadow">
        <div class="card-body">
            <form id="edit-subject"  action="{{ route('admin.exam.subject.update', ['subject' => $subject->id]) }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <label for="name">Subject Name</label>
                        <input type="text" value="{{$subject->name}}" id="name" name="name" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label for="code">Subject Code</label>
                        <input type="text"  value="{{$subject->code}}" id="code" name="code" class="form-control" required>
                    </div>
                    <div class="col-md-2">
                        <label for="credit_hour">Credit Hour</label>
                        <input type="number"  value="{{$subject->credit_hour}}" id="credit_hour" name="credit_hour" class="form-control" required>
                    </div>
                    <div class="col-md-2">
                        <label for="fm">Full Marks</label>
                        <input type="number" value="{{$subject->fm}}"  id="fm" name="fm" class="form-control" required>
                    </div>
                    <div class="col-md-2">
                        <label for="pm">Pass Marks</label>
                        <input type="number" value="{{$subject->pm}}"  id="pm" name="pm" class="form-control" required>
                    </div>


                    {{-- <div class="col-md-2 d-flex align-items-end ">
                        <button class=" w-100 btn btn-primary">Load Subjects</button>
                    </div> --}}
                </div>
                <h5 class="d-flex justify-content-between">
                    <span>
                        Marks Distribution
                    </span>
                    <span class="btn btn-sm btn-primary" onclick="addData()">
                        Add
                    </span>
                </h5>
                <div id="marks-distribution">
                    @foreach ($subject->partials as $partial)
                    <div class="row" id="partial_{{$partial->id}}">
                        <input type="hidden" name="partial[]" value="{{$partial->id}}">
                        <div class="col-md-3">
                            <label for="name_old_{{$partial->id}}"> Name</label>
                            <input type="text" value="{{$partial->name}}" id="name_old_{{$partial->id}}" name="name_old_{{$partial->id}}" class="form-control" required="">
                        </div>
                        <div class="col-md-3">
                            <label for="code_old_{{$partial->id}}"> Code</label>
                            <input type="text"  value="{{$partial->code}}" id="code_old_{{$partial->id}}" name="code_old_{{$partial->id}}" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label for="credit_hour_old_{{$partial->id}}"> Credit Hour</label>
                            <input type="number"  value="{{$partial->credit_hour}}" id="credit_hour_old_{{$partial->id}}" name="credit_hour_old_{{$partial->id}}" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label for="fm_old_{{$partial->id}}">Full Marks</label>
                            <input type="number" value="{{$partial->fm}}" id="fm_old_{{$partial->id}}" name="fm_old_{{$partial->id}}" class="form-control" required="">
                        </div>
                        <div class="col-md-2">
                            <label for="pm_old_{{$partial->id}}">Pass Marks</label>
                            <input type="number" value="{{$partial->pm}}" id="pm_old_{{$partial->id}}" name="pm_old_{{$partial->id}}" class="form-control" required="">
                        </div>
                        <div class="col-md-2 d-flex align-items-center">
                            <span class="btn btn-danger w-100" onclick="delPartial({{$partial->id}})">Del</span>
                        </div>
                        <div class="col-12">
                            <hr>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="py-2">
                    <button class="btn btn-success">
                        Update Mark
                    </button>
                </div>
            </form>
        </div>
    </div>




@endsection
@section('script')
    <script src="{{ asset('admin/plugins/drophify/js/dropify.min.js') }}"></script>
    <script>
        state = false;
        var did = 0;
        var no_change_data = [];

        function switchHolder(on) {
            if (on) {
                $('#add-subject-holder').removeClass('d-none');
                $('#subjects-table-holder').removeClass('d-none');
                $('#load-subject-btn').addClass('d-none');
                $('#reset-subject-btn').removeClass('d-none');
                $('#level_id').attr('readonly', '');
                $('#section_id').attr('readonly', '');
                $('#use-section').attr('readonly', '');
            } else {
                $('#add-subject-holder').addClass('d-none');
                $('#subjects-table-holder').addClass('d-none');
                $('#load-subject-btn').removeClass('d-none');
                $('#reset-subject-btn').addClass('d-none');
                $('#level_id').removeAttr('readonly');
                $('#section_id').removeAttr('readonly');
                $('#use-section').removeAttr('readonly');

            }
        }

        function delPartial(id) {
            const url="{{route('admin.exam.subject.delPartial',['partial'=>'xxx_id'])}}";
            if(prompt('Enter yes To Delete Subect Partial')=='yes'){
                block('#edit-subject');
                axios.get(url.replace('xxx_id',id))
                .then((res)=>{
                    unblock('#edit-subject');
                    
                    $('#partial_'+id).remove();
                })
                .catch((err)=>{
                    unblock('#edit-subject');

                });
            }
        }

        function addData(name) {
            // console.log($('#data-template').html());
            _html = $('#data-template').html();
            html = _html.replaceAll('xxx', did.toString());
            $('#marks-distribution').append(html);
            if (name != null && name != undefined) {
                $('#name_' + did).val(name);
            }
            did += 1;
        }

        function delData(id) {
            $('#data_' + id).remove();
        }

        function resetData() {
            $('#marks-distribution').html('');
            switchHolder(false);
        }


        $(function() {
            // $('#photo').dropify();
            $('#load-subject').submit(function(e) {
                e.preventDefault();
                loadData(e);
            });
            $('#add-subject').submit(function(e) {
                e.preventDefault();
                saveData();
            });
            // initSwitch();
            selectSection(1);
            switchHolder(false);
        });







        function selectSection(ele) {
            const section_data = anotherSelect(data.sections, $('#level_id').val(), 1);
            document.getElementById('use-section').checked = section_data.length > 0;
            $('#section_id').html(getOptions(section_data, 2));
        }
    </script>
@endsection

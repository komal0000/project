@extends('admin.layout.app')
@section('css-include')
    <link rel="stylesheet" href="{{asset('admin/plugins/DataTables/datatables.min.css')}}">
    <style>
        td,th{
            padding:5px !important;
            border: 2px solid #dee2e6 !important;
        }
        .form-marks{
            padding: 5px 10px;
            width: 100%;
            /* max-width: 100px; */
            border:2px solid #727272 !important;
            outline: #727272;
        }
    </style>
@endsection
@section('page-option')
    {{-- <a href="{{route('admin.exam.add')}}" class="btn btn-primary">Add Exam</a> --}}
@endsection
@section('s-title')
    <li class="breadcrumb-item ">{{$data->academic_year}}</li>
    <li class="breadcrumb-item "><a href="{{route('admin.exam.index')}}">Exams</a></li>
    <li class="breadcrumb-item "><a href="{{route('admin.exam.subject.index',['exam'=>$subject->exam_id])}}">{{$data->exam_name}}</a></li>
    <li class="breadcrumb-item ">{{$data->level}}</li>
    @if (isset($data->section))
    
    <li class="breadcrumb-item ">{{$data->section}}</li>
    @endif
    <li class="breadcrumb-item ">{{$subject->name}}</li>
    <li class="breadcrumb-item active">Enter Marks</li>
    
@endsection
@section('content')
    @php
        $p=$subject->partials->count()>0;
    @endphp
    <div class="card shadow mb-3 exam-holder" >
        <div class="card-body">
            <form action="{{route('admin.exam.subject.mark',['subject'=>$subject->id])}}" method="post" id="add-marks">
            
                @csrf
                <table class="table " id="datatable">
                    <thead>
                        <tr>
                            <th {{$p?'rowspan=2':''}}>
                                Roll No
                            </th>
                            <th {{$p?'rowspan=2':''}}>
                                Name
                            </th>
                            
                            @if (!$p)
                            
                                <th>
                                    marks
                                </th>
                                <th >
                                    IsAbsent
                                </th>
                            @else
                            <th colspan="{{$subject->partials->count() *2}}">
                                marks
                            </th>
                            @endif    
                        </tr>
                        @if ($p)
                            <tr>
                               
                                @foreach ($subject->partials as $partial)
                                    <th>
                                        {{$partial->name}}
                                    </th>
                                    <th>
                                        Absent
                                    </th>
                                @endforeach
                            </tr>
                        @endif
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                
                                <th>
                                    {{$student->rollno}}
                                    <input type="hidden" name="students[]" value="{{$student->id}}">
                                </th>
                                <td>
                                    {{$student->name}}
                                </td>
                                @if ($p)
                                    @foreach ($subject->partials as $partial)
                                    <td>
                                        <input type="number" class="form-marks" name="sp_{{$student->id}}_{{$partial->id}}" id="sp_{{$student->id}}_{{$partial->id}}" required >
                                    </td>
                                    <td>
                                        <input type="checkbox" name="ap_{{$student->id}}_{{$partial->id}}" id="ap_{{$student->id}}_{{$partial->id}}">
                                    </td>
                                    @endforeach
                                @else
                                <td>
                                    <input type="number" class="form-marks" name="s_{{$student->id}}" id="s_{{$student->id}}" required>
                                </td>
                                <td>
                                    <input type="checkbox" name="a_{{$student->id}}" id="a_{{$student->id}}">
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-right py-2">
                    <button class="btn btn-primary">Save Marks</button>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{asset('admin/plugins/DataTables/datatables.min.js')}}"></script>
    <script>
        const marks={!! json_encode($data->marks??[]) !!};
        var state=false;
        var table;
        var delurl='{{route('admin.exam.subject.mark',['subject'=>'xxx_id'])}}';
        $(function () {
            console.log(marks);
            marks.forEach(mark => {
                $('#'+mark.m_data).val(mark.m);
                $('#'+mark.a_data)[0].checked=mark.a==1;
            });
            $('#add-marks').submit(function (e) { 
                e.preventDefault();
                let fd=new FormData(document.getElementById('add-marks'));
                if(!state){
                    axios.post($('#add-marks').attr('action'),fd)
                    .then((res)=>{
                        console.log(res.data);
                        toastr.success('Data Saved Successfully');
                    })
                    .catch((err)=>{
                        toastr.error('Data Cannot be Saved');

                        console.log(err.response);
                    });
                }
            });

            
           
        });
      
    </script>
@endsection

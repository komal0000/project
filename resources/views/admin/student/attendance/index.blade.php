@extends('admin.layout.app')
@section('css')
<link rel="stylesheet" href="{{asset('admin/plugins/drophify/css/dropify.min.css')}}">
<style>
    .col-md-3{
        margin-bottom:10px;
    }
    .no-change{
        margin-right:5px;
    }

     td, th {
         text-align: center !important;
        padding: 5px !important;
        /* min-width: 150px !important; */
        border: 1px solid #b8b8b8 !important;
    }
    .input{
        width: 100%;
        border: none;
        height: 100%;
        padding:5px 10px;
        outline: transparent;
        text-align: right
    }
    .input-holder{
        border:1px solid black !important;
    }

    .w-15{
        width: 15%;
    }
    .w-25{
        width: 30%;
    }
    .w-45{
        width: 45%;
    }
    /* table tr:first-child th{
        border:none !important;
    } */
    /* .form-control{
        padding: 0.375rem 0.75rem !important;
    } */
</style>
@endsection
@section('page-option')
@endsection
@section('s-title')

<li class="breadcrumb-item active">Students</li>
<li class="breadcrumb-item active">
    Attendances
</li>

@endsection
@section('content')
    <script>
        _data={!! json_encode($data,true) !!};
        data=getData(_data);
        
    </script>
  
    <div class="card shadow mb-4"  id="load-students-holder">
        <div class="card-body">
           <form action="{{route('admin.student.attendance.index')}}" id="load-students" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <label for="date">Date</label>
                        <input type="date" name="date" id="date" class="form-control">
                    </div>
                    <div class="col-md-4">
                        
                        <label for="level_id">  Level</label>
                        <select name="level_id" id="level_id" class="form-control" onchange="selectSection(this);">
                            <script>
                                document.write(getOptions(data.levels));
                            </script>
                        </select>
                    </div>
                    <div class="col-md-4">
                        
                        <label for="section_id"> <input  type="checkbox" value="1" id="use-section"> Section</label>
                        <select name="section_id" id="section_id" class="form-control">
                            
                        </select>
                    </div>
                    <div class="col-md-12 py-2 text-right">
                        <button class="btn btn-primary" id="load-subject-btn">Load Data</button>
                        <span class="btn btn-danger d-none" id="reset-subject-btn" onclick="resetData()">reset Data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow" id="add-attendance-holder">
        <div class="card-body">
            
            <div style="overflow-x:auto;max-width:100%;">
                <form action="{{route('admin.student.attendance.add')}}" id="add-attendance" method="post">
                    @csrf
                    <table id="datatable" class="w-100">
                        <tr>
                            <th>
                                Roll<br>No
                            </th>
                            <th>
                                Name
                            </th>
                            <th>
                                
                            </th>
                        </tr>
                        <tbody id="attendance-data">

                        </tbody>
                    </table>
                    <div class="py-2">
                        <button class="btn btn-primary" id="save-point">Save Data</button>
                        <span class="btn btn-danger" id="save-point" onclick="switchHolder(false)">Close</span>
                    </div>
                </form>
            </div>
        </div>
    </div>


   

@endsection
@section('script')
<script src="{{asset('admin/plugins/drophify/js/dropify.min.js')}}"></script>
<script>
    state=false;
    var students;
    var adata;
    var did=0;
    var no_change_data=[];
    var date;
    var curDate;
    function  switchHolder(on) {
        if(on){
            $('#add-attendance-holder').removeClass('d-none');
            $('#load-students-holder').addClass('d-none');
            $('#load-subject-btn').addClass('d-none');
            $('#reset-subject-btn').removeClass('d-none');
            $('#level_id').attr('readonly', '');
            $('#section_id').attr('readonly', '');
            $('#use-section').attr('readonly', '');
        }else{
            $('#add-attendance-holder').addClass('d-none');
            $('#load-students-holder').removeClass('d-none');
            $('#load-subject-btn').removeClass('d-none');
            $('#reset-subject-btn').addClass('d-none');
            $('#level_id').removeAttr('readonly');
            $('#section_id').removeAttr('readonly');
            $('#use-section').removeAttr('readonly');

        }
    }
    function  addData(name) {
        // console.log($('#data-template').html());
        _html=$('#data-template').html();
        html=_html.replaceAll('xxx',did.toString());
        $('#marks-distribution').append(html);
        if(name!=null && name!=undefined){
            $('#name_'+did).val(name);
        }
        did+=1;
    }
    function delData(id) {
        $('#data_'+id).remove();
    }

    function resetData(){
        $('#marks-distribution').html('');
        switchHolder(false);
    }
   
    
    function getCurDate(i) {
        if(i!=undefined){
            date=date;
        }
        year=date.getFullYear();
        month=date.getMonth()+1;
        day=date.getDate();
        curdate=year+'-'+(month<10?('0'+month):month)+'-'+(day<10?('0'+day):day);
    }

    $(function () {
        // $('#photo').dropify();
        $('#load-students').submit(function (e) {
            e.preventDefault();
            loadData(this);
        });
        $('#add-attendance').submit(function (e) {
            e.preventDefault();
            saveData(this);
        });
        date =new Date();
        $('#date').val(formatDate(date));
        // initSwitch();
        selectSection(1);
        switchHolder(false);
    });

    function loadData(ele) {
        let fd=new FormData(ele);
        axios.post($(ele).attr('action'),fd)
        .then((res)=>{
            let html="";
            if(res.data.students.length>0){

                res.data.students.forEach(student => {
                    html+="<tr>"+
                    '<th>'+student.rollno+'</th>'+
                    '<td>'+student.name+'</td>'+
                    '<td><input type="checkbox" value="1" name="std_'+student.id+'" id="std_'+student.id+'"/>'+
                    '<input type="hidden" value="'+student.id+'" name="std[]"/></td>'+
                    "</tr>";
                });
                $('#attendance-data').html(html);
                switchHolder(true);
                document.getElementById('attendance-data').scrollIntoView();

                res.data.attendances.forEach(attendance => {
                    document.getElementById(attendance.id).checked=attendance.present==1;
                });
            }else{
                toastr.warning('No Student Found');
            }
        })
        .catch((err)=>{
            toastr.error('Data Cannot be  Saved,'+err.response.data.message);

        })
    }

    function saveData(ele) {
        block('#add-attendance-holder');
        let fd=new FormData(ele);
        fd.append('date',$('#date').val());
        axios.post($(ele).attr('action'),fd)
        .then((res)=>{
            if(res.data.status){
                toastr.success('Attendance Saved Sucessfully');
            }else{
                toastr.success('Attendance Cannot be Saved');

            }
            unblock('#add-attendance-holder');

        })
        .catch((err)=>{
            unblock('#add-attendance-holder');
            toastr.success('Attendance Cannot be Saved,'+err.response.data.message);
        });
    }


  
    function selectSection(ele){
        const section_data=anotherSelect(data.sections,$('#level_id').val(),1);
        document.getElementById('use-section').checked=section_data.length>0;
        $('#section_id').html(getOptions(section_data,2));
    }
   
</script>
@endsection

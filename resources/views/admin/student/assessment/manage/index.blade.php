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
        min-width: 150px !important;
        border: 1px solid #b8b8b8 !important;
    }
    .input{
        width: 100%;
        border: 1px solid #b8b8b8 !important;
        /* border: none; */
        height: 100%;
        padding:5px 10px;
        outline: transparent;
        text-align: right;
        top:0px;
        left:0px;
        position: absolute;

    }

    input:focus,input:hover{
        border: 2px solid #2d91d4 !important;
        z-index: 9;

    }
    .input-holder{
        border:none !important;
        position: relative;
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
<li class="breadcrumb-item active"><a href="{{route('admin.assessment.index')}}">Assessments</a></li>
<li class="breadcrumb-item active">
    Manage
</li>

@endsection
@section('content')
    <script>
        _data={!! json_encode($data,true) !!};
        data=getData(_data);
        
    </script>
  
    <div class="card shadow mb-4" id="load-student-holder">
        <div class="card-body">
           <form action="#" id="load-students" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        
                        <label for="level_id">  Level</label>
                        <select name="level_id" id="level_id" class="form-control" onchange="selectSection(this);">
                            <script>
                                document.write(getOptions(data.levels));
                            </script>
                        </select>
                    </div>
                    <div class="col-md-6">
                        
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

    <div class="card shadow" id="add-point-holder">
        <div class="card-body">
            
            <form action="{{route('admin.assessment.addPoint',['id'=>$assessment->id])}}" id="add-point" method="post">
                <div style="overflow-x:auto;max-width:925px;padding:20px 0px; ">
                    @csrf
                    <table id="datatable" >
    
                    </table>
                </div>
                <div class="py-2">
                    <button class="btn btn-primary" id="save-point">Save Data</button>
                    <span class="btn btn-danger" id="close-point" onclick="switchHolder(false);">Close</span>
                </div>
            </form>
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
    function  switchHolder(on) {
        if(on){
            // $('#add-subject-holder').removeClass('d-none');
            // $('#subjects-table-holder').removeClass('d-none');
            $('#load-student-holder').addClass('d-none');
            $('#add-point-holder').removeClass('d-none');
           
        }else{
            // $('#add-subject-holder').addClass('d-none');
            // $('#subjects-table-holder').addClass('d-none');
            $('#load-student-holder').removeClass('d-none');
            $('#add-point-holder').addClass('d-none');
           

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
   

    $(function () {
        // $('#photo').dropify();
        $('#load-students').submit(function (e) {
            e.preventDefault();
            loadData(e);
        });
        $('#add-point').submit(function (e) {
            e.preventDefault();
            saveData(this);
        });
        // initSwitch();
        selectSection(1);
        switchHolder(false);
    });

  

    function saveData(ele) {
        block('#add-point-holder');
        let fd=new FormData(ele);
        axios.post($(ele).attr('action'),fd)
        .then((res)=>{
            unblock('#add-point-holder');
            toastr.success('Data Saved Sucessfully');
        })
        .catch((err)=>{
            unblock('#add-point-holder');
            toastr.error('Data Cannot be  Saved,'+err.response.data.message);

        })
    }

    function loadData(e){
        let fd=new FormData();
        fd.append('level_id',$('#level_id').val());
        if(document.getElementById('use-section').checked){
            fd.append('section_id',$('#section_id').val());
        }
        axios.post('{{route('admin.assessment.manage',['id'=>$assessment->id])}}',fd)
        .then((res)=>{
            // console.log(res.data);
            students=res.data.students;
            if(students.length>0){

                adata=res.data.adata;
                
                let headhtml='<tr>';
                let headhtml1='<tr>';
                 headhtml+='<th rowspan="2">Roll No</th>';
                 headhtml+='<th rowspan="2">Name</th>';
                 adata.forEach(ele => {
                 headhtml+='<th colspan="'+ele.options.length+'">'+ele.name+'</th>';
                    ele.options.forEach(option => {
                     headhtml1+='<th>'+
                        option[0]+
                        '<input type="hidden" name="options[]" value="'+option[1]+'"/>'+
    
                        '</th>';
                    });
                 });
                  headhtml+='</tr>';
                 headhtml1+='</tr>';
                $('#datatable').html(headhtml);
                $('#datatable').append(headhtml1);
    
                let studenthtml="";
                
                students.forEach(student => {
                    studenthtml+="<tr>";
                    studenthtml+='<th>'+
                    '<input type="hidden" name="std[]" value="'+student.id+'"/>'+
                    student.rollno+
                    '</th>';
                    studenthtml+='<td>'+student.name+'</td>';
                    adata.forEach(ele => {
                    ele.options.forEach(option => {
                     studenthtml+='<th class="input-holder">'+
                     '<input class="input focus-select" name="std_'+student.id+'_'+option[1]+'" id="std_'+student.id+'_'+option[1]+'" type="number" min="0" max="5">'+
                     '</th>';
                    });
    
                 });
                    studenthtml+="</tr>";
                    
                });
                 $('#datatable').append(studenthtml);
    
                 res.data.points.forEach(point => {
                     $('#'+point.id).val(parseFloat( point.point)+0);
                 });
    
                 startFocusSelect();
                 switchHolder(true);
            }else{
                toastr.warning('No Student Found.')
            }
            // $('#student-holder').html('');
            // console.log(res.data);
            // res.data.forEach(sub => {
            //     renderData(sub);
            // });
            // // $('#marks-distribution').html('');
            // // $('#add-subject')[0].reset();
            // toastr.success('Subjects Loaded Sucessfully');
            // switchHolder(true);
        })
        .catch((err)=>{
            console.log(err.response.data);
            toastr.success('Subject Not Loaded, '+err.response.data.message);

        });
    }

  
    function selectSection(ele){
        const section_data=anotherSelect(data.sections,$('#level_id').val(),1);
        document.getElementById('use-section').checked=section_data.length>0;
        $('#section_id').html(getOptions(section_data,2));
    }
   
</script>
@endsection

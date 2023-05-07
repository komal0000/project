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

    .table td, .table th {
        padding: 5px !important;
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
    table tr:first-child th{
        border:none !important;
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
    <a href="{{route('admin.exam.index')}}">Exams</a>
</li>
 <li class="breadcrumb-item">
    <a href="{{route('admin.exam.info',['id'=>$exam->id])}}">{{$exam->name}}</a>
</li>
<li class="breadcrumb-item active">
    Setup
</li>
@endsection
@section('content')
    <script>
        _data={!! json_encode($data,true) !!};
        data=getData(_data);
        
    </script>
    @include('admin.exam.setup.template')
  
    <div class="card shadow mb-4">
        <div class="card-body">
           <form action="#" id="load-subject" method="post" enctype="multipart/form-data">
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
                        <button class="btn btn-primary" id="load-subject-btn">Load Subjects</button>
                        <span class="btn btn-danger d-none" id="reset-subject-btn" onclick="resetData()">reset Subjects</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @include('admin.exam.setup.part')

   

@endsection
@section('script')
<script src="{{asset('admin/plugins/drophify/js/dropify.min.js')}}"></script>
<script>
    state=false;
    var did=0;
    var no_change_data=[];
    var delurl='{{route('admin.exam.subject.del',['subject'=>'xxx_id'])}}';

    function  switchHolder(on) {
        if(on){
            $('#add-subject-holder').removeClass('d-none');
            $('#subjects-table-holder').removeClass('d-none');
            $('#load-subject-btn').addClass('d-none');
            $('#reset-subject-btn').removeClass('d-none');
            $('#level_id').attr('readonly', '');
            $('#section_id').attr('readonly', '');
            $('#use-section').attr('readonly', '');
        }else{
            $('#add-subject-holder').addClass('d-none');
            $('#subjects-table-holder').addClass('d-none');
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
    function saveData(){
        let fd=new FormData(document.getElementById('add-subject'));
        fd.append('level_id',$('#level_id').val());
        if(document.getElementById('use-section').checked){
            fd.append('section_id',$('#section_id').val());
        }
        axios.post('{{route('admin.exam.subject.add',['exam'=>$exam->id])}}',fd)
        .then((res)=>{
            console.log(res.data);
            renderData(res.data);
            $('#marks-distribution').html('');
            $('#add-subject')[0].reset();
            toastr.success('Subject Added Sucessfully');
        })
        .catch((err)=>{
            console.log(err.response.data);
            toastr.success('Subject Not Added, '+err.response.data.message);

        });
    }

    $(function () {
        // $('#photo').dropify();
        $('#load-subject').submit(function (e) {
            e.preventDefault();
            loadData(e);
        });
        $('#add-subject').submit(function (e) {
            e.preventDefault();
            saveData();
        });
        // initSwitch();
        selectSection(1);
        switchHolder(false);
    });

    function renderData(subject){
        try {
            _html=$('#subject-template').html();
            html=_html.replaceAll('xxx_tr','tr');
            html=html.replaceAll('xxx_td','td');
            html=html.replaceAll('xxx_th','th');
            html=html.replaceAll('xxx_id',subject.id);
            html=html.replaceAll('xxx_credit',subject.credit_hour);
            html=html.replaceAll('xxx_sub',subject.name);
            html=html.replaceAll('xxx_code',subject.code);
            html=html.replaceAll('xxx_marks','<strong class="mr-2">FM:</strong>'+subject.fm+'<hr class="my-1"><strong class="mr-2">PM:</strong>'+subject.pm);
            let semi_html='';
            if(subject.partials.length>0){

                semi_html+='<table class="w-100"><tr ><th class="w-45">Name</th><th class="w-25">Code</th><th class="w-25">Credit</th><th class="w-15">FM</th><th class="w-15">PM</th></tr>';
                subject.partials.forEach(partial => {
                    semi_html+="<tr><td>"+partial.name+"</td><td>"+partial.code+"</td><td>"+partial.credit_hour+"</td><td>"+partial.fm+"</td><td>"+partial.pm+"</td></tr>";
                });
                semi_html+="</table>";
            }
            html=html.replaceAll('xxx_dis',semi_html);

            $('#subjects-holder').append(html);
            
        } catch (error) {
            console.log(error);
        }
    }



    function loadData(e){
        let fd=new FormData();
        fd.append('level_id',$('#level_id').val());
        if(document.getElementById('use-section').checked){
            fd.append('section_id',$('#section_id').val());
        }
        axios.post('{{route('admin.exam.subject.index',['exam'=>$exam->id])}}',fd)
        .then((res)=>{
            $('#subjects-holder').html('');
            console.log(res.data);
            res.data.forEach(sub => {
                renderData(sub);
            });
            // $('#marks-distribution').html('');
            // $('#add-subject')[0].reset();
            toastr.success('Subjects Loaded Sucessfully');
            switchHolder(true);
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


    function del(id){
        if(confirm("Do You Want To delete Subect?")){
            $pass=prompt('Enter Password For Your Account');
            axios.post(delurl.replace('xxx_id',id),{"pass":$pass})
            .then((res)=>{
                if(res.data.status){
                    $('#sub_'+id).remove();
                    toastr.success('Subject Deleted');

                }else{
                    del_stage(res.data.msg,id);
                }
            })
            .catch((err)=>{
                alert(err.response.data.message);
            });
        }
    }

    function del_stage(msg,id){
        if(confirm(msg)){
            $pass=prompt('Enter Password For Your Account');
            axios.post(delurl.replace('xxx_id',id),{'pass':$pass,"stage":1})
            .then((res)=>{
                if(res.data.status){
                    $('#sub_'+id).remove();
                    toastr.success('Subject Deleted');
                }else{
                    alert(res.data.msg);
                }
            })
            .catch((err)=>{
                alert(err.response.data.message);

            });
        }
    }
   
</script>
@endsection

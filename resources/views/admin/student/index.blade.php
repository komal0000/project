@extends('admin.layout.app')
@section('css-include')
    <link rel="stylesheet" href="{{asset('admin/plugins/DataTables/datatables.min.css')}}">
@endsection
@section('page-option')
    <a href="{{route('admin.student.add')}}" class="btn btn-primary">Add Student</a>
@endsection
@section('s-title')
    <li class="breadcrumb-item active">Students</li>
@endsection
@section('content')
<script>
    _data={!! json_encode($data,true) !!};
    data=getData(_data);
</script>
<div class="card shadow">
    <div class="card-body">
        <div class="row">
           
            <div class="col-md-3">
                <label for="a_y_id">Academic Year</label>
                <select class="form-control" name="a_y_id" id="a_y_id">
                    <script>
                        document.write(getOptions(data.academic_years));
                    </script>
                </select>
            </div>
            <div class="col-md-3">
                <label for="l_id">Level</label>
                <select class="form-control" name="l_id" id="l_id" onchange="selectSection(this);">
                    <script>
                        document.write(getOptions(data.levels));
                    </script>
                </select>
            </div>
            <div class="col-md-3">
                <label for="s_id"> <input type="checkbox"  id="has_s_id"> Section</label>
                <select class="form-control" name="s_id" id="s_id">
                    
                </select>
            </div>
            <div class="col-md-3 d-flex align-items-end py-1">
                <button class="btn btn-primary" onclick="loadData()">Load Students</button>
            </div>
        </div>
    </div>
</div>
    <span type="text/template" id="template-holder" class="d-none">
        <table id="xxx" class="table">
            <thead>
                <tr>
                    <th>
                        Admission No
                    </th>
                    <th>
                        Roll No
                    </th>
                    <th>
                        Name
                    </th>
                    <th>
                        Phone
                    </th>
                 
                    <th>
                        Class
                    </th>
                    <th>
                        Gender
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </span>
    <div class="card shadow mb-3">
        <div class="card-body" id="table-holder">
           
        </div>
    </div>

@endsection
@section('script')
    <script src="{{asset('admin/plugins/DataTables/datatables.min.js')}}"></script>
    <script>
        var table;
        $(function () {
           
            selectSection(1);
        });

        function  initateTable(data) {
            
        }


        function loadData(){
            axios.post('{{route('admin.student.index')}}',{
                a_y_id:$('#a_y_id').val(),
                l_id:$('#l_id').val(),
                s_id:$('#has_s_id')[0].checked?$('#s_id').val():null,
            })
            .then((res)=>{
                console.log(res.data);
                html_holder=$('#template-holder').html();
                html_holder=html_holder.replace('xxx','datatable');
                html="";
                $('#table-holder').html(html_holder);
                res.data[0].forEach(std => {
                    // console.log(std);
                    html+="<tr>"+
                        "<td>"+std.admission_no+"</td>"+
                        "<td>"+std.rollno+"</td>"+
                        "<td>"+std.s_name+"</td>"+
                        "<td>"+std.phone+"</td>"+
                  
                        "<td>"+std.l_name+"</td>"+
                        "<td>"+genders[std.gender]+"</td>"+
                        "<td>"+
                        "<a target='_blank' href='{{route('admin.student.update')}}?id="+std.id+"'>Edit</a> | "+
                        "<a target='_blank' href='{{route('admin.student.detail')}}?id="+std.id+"'>Detail</a>"+
                        "</td>"+
                            
                        "</tr>";
                });
                $('#datatable tbody').html(html);

                table=$('#datatable').DataTable({
                    "columnDefs": [
                        { "sortable":false,"searchable": false, "targets": 7 }
                    ]
                });
            })
            .catch((err)=>{

            });
        }

        function selectSection(ele){
            $('#s_id').html(getOptions(anotherSelect(data.sections,$('#l_id').val(),1),2));
        }
        
    </script>
@endsection

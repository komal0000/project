<div class="card shadow mb-3">
    <div class="card-body">
       <form action="{{route('admin.student.add')}}" id="add-student" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-3">
                    <label for="name">Subject Name</label>
                    <input type="text" id="name" name="name" class="form-control">
                </div>
                <div class="col-md-3">
                    
                    <label for="section_id"> <input  type="checkbox" value="1" id="use-section"> Section</label>
                    <select name="section_id" id="section_id" class="form-control">
                        
                    </select>
                </div>
                <div class="col-md-12 py-2 text-right">
                    <button class="btn btn-primary">Load Subjects</button>
                </div>
            </div>
        </form>
        
        <hr>

        <table class="table">
            <tr>
                <th>
                    Subject
                </th>
                <th>
                    Subject Code
                </th>
                <th>
                    Fullmarks
                </th>
                <th>
                    Passmarks
                </th>
                <th>
                    Distribution
                </th>
                <th>

                </th>
            </tr>
        </table>
    </div>
</div>
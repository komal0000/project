<div class="card shadow mb-4" id="add-subject-holder">
    <div class="card-body">
        <form action="{{route('admin.exam.subject.add',['exam'=>$exam->id])}}" id="add-subject" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-3">
                    <label for="name">Subject Name</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label for="code">Subject Code</label>
                    <input type="text" id="code" name="code" class="form-control" required>
                </div>
                <div class="col-md-2">
                    <label for="credit_hour">Credit Hour</label>
                    <input type="number" id="credit_hour" name="credit_hour" class="form-control" required>
                </div>
                <div class="col-md-2">
                    <label for="fm">Full Marks</label>
                    <input type="number" id="fm" name="fm" class="form-control" required>
                </div>
                <div class="col-md-2">
                    <label for="pm">Pass Marks</label>
                    <input type="number" id="pm" name="pm" class="form-control" required>
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
                
            </div>
            <div class="py-2">
                <button class="btn btn-success">
                    Add Mark
                </button>
            </div>
        </form>
    </div>
</div>

<div class="card shadow" id="subjects-table-holder">
    <div class="card-body">
        <table class="table" id="subjects-table">
            <tr>
                <th>
                    Subject
                </th>
                <th>
                    Subject Code
                </th>
                <th>
                    Credit Hour
                </th>
                <th>
                    Marks
                </th>
                <th>
                    Distriution
                </th>
                <th>
    
                </th>
            </tr>
            <tbody id="subjects-holder">

            </tbody>
        </table>
    </div>
</div>
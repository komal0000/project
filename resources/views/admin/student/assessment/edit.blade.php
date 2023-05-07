<div class="modal fade bd-example-modal-lg" id="edit-assessment-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{route('admin.assessment.update')}}" method="post" id="edit-assessment">
                @csrf
                <input type="hidden" name="id" id="eid">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Edit Assesment</h5>
                    <span type="span" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="material-icons">close</i>
                    </span>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-5">
                            <label for="eacademic_year_id">Academic Year</label>
                            <select class="form-control" name="academic_year_id" id="eacademic_year_id">
                                <script>
                                    document.write(getOptions(data.academic_years));
                                </script>
                            </select>
                        </div>
                        <div class="col-md-7">
                            <label for="ename">Name</label>
                            <input type="text" name="name" id="ename" class="form-control" required>
                        </div>
                 
                    </div>
                </div>
                <div class="modal-footer">
                    <span class="btn btn-secondary" data-dismiss="modal">Close</span>
                    <button type="button" class="btn btn-primary">Update Assessment</button>
                </div>
            </form>
        </div>
    </div>
</div>
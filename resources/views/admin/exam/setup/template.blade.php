<span class="d-none" id="data-template">
    <div class="row" id="data_xxx">
        <input type="hidden" name="dis[]" value="xxx">
        <div class="col-md-3">
            <label for="name_xxx"> Name</label>
            <input type="text" id="name_xxx" name="name_xxx" class="form-control" required>
        </div>
        <div class="col-md-2">
            <label for="credit_hour_xxx">Credit Hour</label>
            <input type="number" id="credit_hour_xxx" name="credit_hour_xxx" class="form-control" >
        </div>
        <div class="col-md-3">
            <label for="code_xxx"> Code</label>
            <input type="text" id="code_xxx" name="code_xxx" class="form-control" >
        </div>
        <div class="col-md-2">
            <label for="fm_xxx">Full Marks</label>
            <input type="number" id="fm_xxx" name="fm_xxx" class="form-control" required>
        </div>
        <div class="col-md-2">
            <label for="pm_xxx">Pass Marks</label>
            <input type="number" id="pm_xxx" name="pm_xxx" class="form-control" required>
        </div>
        <div class="col-md-2 d-flex align-items-center">
            <span class="btn btn-danger w-100" onclick="delData(xxx)">Del</span>
        </div>
        <div class="col-12">
            <hr>
        </div>
    </div>
</span>

<span class="d-none subjects-template">
    <table class="table" id="table_xxxx">
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
    </table>
</span>

<span class="d-none " id="subject-template">
    <xxx_tr  id="sub_xxx_id">
        <xxx_th>
            xxx_sub
        </xxx_th>
        <xxx_td>
            xxx_code
        </xxx_td>
        <xxx_td>
            xxx_credit
        </xxx_td>
        <xxx_td>
            xxx_marks
        </xxx_td>
        <xxx_td>
            xxx_dis
        </xxx_td>
        <xxx_td style="max-width: 75px;">
            <a class="btn btn-sm btn-success w-100" href="{{route('admin.exam.subject.mark',['subject'=>'xxx_id'])}}">
                Enter Marks
            </a> 
            
            <a class="btn mt-1 btn-sm btn-success w-100" href="{{route('admin.exam.subject.update',['subject'=>'xxx_id'])}}">
                Edit
            </a>
            <span class="btn mt-1 btn-sm btn-danger w-100" onclick="del(xxx_id)">
                Del
            </span>
        </xxx_td>
    </xxx_tr>
</span>

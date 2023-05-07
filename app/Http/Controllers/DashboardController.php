<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function upload(Request $request)
    {
        // dd($request->allFiles());
        $data=$request->allFiles()['file']->store('uploads/tiny');
        return response(asset($data));
    }
    public function index(){
        return view('admin.dashboard.index');

    }
    public function index_old(Request $request){
        if($request->getMethod()=="POST"){
            $query="select count(id),religion_id from students group by religion_id";
        }else{

            $data=DB::selectOne(
                "select ".
                "(select avg(att.attendance) from (select count(id) as attendance from attendances group by student_id ) as att) as attendance,".
                "(select count(*) from students) as students,".
                "(select count(*) from employees) as employees,".
                "(select group_concat(rq.data) from ".
                "(select concat(religion_id,':',count(id)) as data from students group by religion_id) as rq) as religion_data, ".
                "(select group_concat(id,':',name) from religions) as religions,".
                "(select group_concat(cq.data) from ".
                "(select concat(caste_id,':',count(id)) as data from students group by caste_id) as cq) as caste_data, ".
                "(select group_concat(id,':',name) from castes) as castes,".
                "(select group_concat(ccq.data) from ".
                "(select concat(category_id,':',count(id)) as data from students group by category_id) as ccq) as category_data, ".
                "(select group_concat(id,':',name) from categories) as categories,".
                "(select count(id) from students where is_handicap=1) as handicapped,".
                "(select count(id) from students where has_genetic_disorder=1) as genetic_disorder,".
                "(select count(id) from students where is_mentally_chalanged=1) as mentally_chalanged,".
                "(select count(id) from students where bpl=1) as bpl"
            );
            // dd($data);
            // $religion_count= "select count(id),religion_id from students group by religion_id";
            return view('admin.dashboard.indexall',compact('data'));
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentAttendanceController extends Controller
{
    public function add(Request $request){
        if($request->getMethod()=="POST"){
            $query="select id from academic_years where status=1 and (start_date <='{$request->date}' and end_date >= '{$request->date}') order by end_date desc limit 1";
            $ay=DB::selectOne($query);
            if($ay==null){
                throw new \Exception('Cannot Determine Academic Year For Date');
            }
            // dd($ay->id,$query);
    
            $data=Attendance::whereIn('student_id',$request->std)->where('date',$request->date)->get();
            foreach ($request->std as $sid) {
                $onedata=$data->where('student_id',$sid)->where('date',$request->date)->first();
                if($onedata==null){
                    $onedata=new Attendance();
                    $onedata->student_id=$sid;
                    $onedata->academic_year_id=$ay->id;
                    $onedata->date=$request->date;
                }
                $onedata->present=$request->input('std_'.$sid)??0;
                $onedata->save();
            }
            return response()->json(['status'=>true]);
        }

    }
    public function index(Request $request){
        if($request->getMethod()=="POST"){
            //Get Academicyear Using Date 
            $query_ay="select id from academic_years where status=1 and (start_date <='{$request->date}' and end_date >= '{$request->date}') order by end_date desc limit 1";
            //get student of that academic year
            // return response()->json(DB::selectOne($query_ay));
            $query = 'select s.name,s.id,sr.rollno from student_registrations sr join students s on sr.student_id=s.id where sr.academic_year_id=('.$query_ay.')'.' and sr.level_id=' . $request->level_id .($request->section_id != null ? (' and sr.section_id=' . $request->section_id) : '');

            $students = DB::select($query);
         

            $query_id = 'select s.id from student_registrations sr join students s on sr.student_id=s.id where sr.academic_year_id=('.$query_ay.')'.' and sr.level_id=' . $request->level_id .($request->section_id != null ? (' and sr.section_id=' . $request->section_id) : '');
            

            $attendances=DB::select("select concat('std_',student_id) as id, present from attendances where date='{$request->date}' and student_id in ({$query_id})");

            return response()->json(compact('students','attendances'));
        }else{
            $data = DB::selectOne('select
            (select GROUP_CONCAT(id,concat(":",title)) from levels) as levels,
            (select GROUP_CONCAT(id,concat(":",title)) from academic_years) as academic_years,
            (select GROUP_CONCAT(id,concat(":",level_id),concat(":",title)) from sections) as sections
            ');
            return view('admin.student.attendance.index',compact('data'));
        }
    }
}

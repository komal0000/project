<?php

namespace App\Http\Controllers\Admin;

use App\Data;
use App\Http\Controllers\Controller;
use App\Models\Assessment;
use App\Models\AssessmentPart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssessmentController extends Controller
{
    public function add(Request $request){
        return response()->json(Assessment::create($request->except('_token')));
    }
    public function del(Request $request){
        $assessment=Assessment::where('id',$request->id)->first();
        $assessment->delete();
        return response()->json(['status'=>true]);
    }

    public function update(Request $request){
        $assessment=Assessment::where('id',$request->id)->first();
        $assessment->academic_year_id=$request->academic_year_id;
        $assessment->name=$request->name;
        $assessment->save();
        return response()->json($assessment);
    }
    public function index()
    {
        $data = DB::selectOne('select
        (select GROUP_CONCAT(id,concat(":",title)) from levels) as levels,
        (select GROUP_CONCAT(id,concat(":",title)) from academic_years) as academic_years,
        (select GROUP_CONCAT(id,concat(":",level_id),concat(":",title)) from sections) as sections
        ');
        $assessments=Assessment::join('academic_years','academic_years.id','=','assessments.academic_year_id')
        ->select('academic_years.title','name','assessments.id','assessments.academic_year_id')->get();
        return view('admin.student.assessment.index',compact('data','assessments'));
    }

    public function addPoint(Request $request)
    {
        // return response()->json($request->all());

        $assessment=Assessment::where('id',$request->id)->first();
        if($request->filled('std') && $request->filled('options')){
            foreach ($request->std as $sid) {
                foreach ($request->options as $option) {
                    # code...
                    $point=AssessmentPart::where('student_id',$sid)
                    ->where('assessment_id',$request->id)
                    ->where('code',$option)
                    ->first();
                    if($point==null){
                        $point=new AssessmentPart();
                        $point->student_id=$sid;
                        $point->assessment_id=$request->id;
                        $point->academic_year_id=$assessment->academic_year_id;
                        $point->code=$option;

                    }
                    $point->point=$request->input("std_".$sid."_".$option)??0;
                    $point->save();
                }
            }
        }
        return response()->json(['status'=>true]);
        
    }
    public function manage(Request $request){

        $assessment=Assessment::where('id',$request->id)->first();
        if($request->method()=="POST"){
           
            $query = 'select s.name,s.id,sr.rollno from student_registrations sr join students s on sr.student_id=s.id where sr.academic_year_id=' . $assessment->academic_year_id . ' and sr.level_id=' . $request->level_id . ($request->section_id != null ? (' and sr.section_id=' . $request->section_id) : '');
            // dd($data,$query);
            $students = DB::select($query);
            $adata=Data::assesments;
            $point_query="select concat('std_',s.id,'_',a.code) as id,point from students s join assessment_parts a on s.id=a.student_id where a.assessment_id=".$request->id;
            $points=DB::select($point_query);
            return response()->json(compact('students','adata','points'));
        }else{
            $data = DB::selectOne('select
            (select GROUP_CONCAT(id,concat(":",title)) from levels) as levels,
            (select GROUP_CONCAT(id,concat(":",title)) from academic_years) as academic_years,
            (select GROUP_CONCAT(id,concat(":",level_id),concat(":",title)) from sections) as sections
            ');
            return view('admin.student.assessment.manage.index',compact('data','assessment'));
        }
       
    }
}

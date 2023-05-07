<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExamController extends Controller
{
    public function add(Request $request)
    {
        if ($request->getMethod() == "POST") {
            Exam::create($request->except('_token'));
            return response()->json(['status' => true]);
        } else {

            return view('admin.exam.add', [
                'acs' => DB::table('academic_years')->where('status', 1)->get(['id', 'title'])
            ]);
        }
    }

    public function delete(Exam $exam)
    {
        $exam->delete();
        return response()->json(['status' => true]);
    }
    public function update(Request $request, Exam $exam)
    {
        if ($request->getMethod() == "POST") {
            $exam->name = $request->name;
            $exam->start = $request->start;
            $exam->end = $request->end;
            $exam->academic_year_id = $request->academic_year_id;
            $exam->save();
            return response()->json(['status' => true]);
        } else {

            return view('admin.exam.edit', [
                'acs' => DB::table('academic_years')->where('status', 1)->get(['id', 'title']),
                'exam' => $exam
            ]);
        }
    }

    public function index()
    {
        $exams = DB::table('exams')->join('academic_years', 'academic_years.id', '=', 'exams.academic_year_id')
            ->select(DB::raw('exams.id,exams.name,exams.start,exams.end,academic_years.title as ac'))->orderBy('exams.end', 'DESC')->get();
        // dd($exams);
        return view('admin.exam.index', compact('exams'));
    }

    public function info(Request $request,$id)
    {
        
        $exam = DB::table('exams')->join('academic_years', 'academic_years.id', '=', 'exams.academic_year_id')
            ->select(DB::raw('exams.id,exams.name,exams.start,exams.end,academic_years.title as ac'))->where('exams.id',$id)->first();
            // dd($exam);
        return view('admin.exam.info',compact('exam'));

    }
}

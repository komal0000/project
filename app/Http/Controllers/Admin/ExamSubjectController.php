<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamMark;
use App\Models\ExamMarkPart;
use App\Models\ExamSubject;
use App\Models\ExamSubjectParts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ExamSubjectController extends Controller
{
    public function index(Request $request, Exam $exam)
    {
        if ($request->getMethod() == "POST") {
            $query = ExamSubject::with('partials')->where('exam_id', $exam->id)->where('level_id', $request->level_id);
            if ($request->filled('section_id')) {
                $query = $query->where('section_id', $request->section_id);
            }
            return response()->json($query->get());
        } else {
            $data = DB::selectOne('select
            (select GROUP_CONCAT(id,concat(":",title)) from levels) as levels,
            (select GROUP_CONCAT(id,concat(":",level_id),concat(":",title)) from sections) as sections
            ');
            return view('admin.exam.setup.add', compact('data', 'exam'));
        }
    }

    public function add(Request $request, Exam $exam)
    {
        if ($request->getMethod() == "POST") {
            // return response()->json($request->all());

            $subject = new ExamSubject();
            try {
                //code...
                $subject->name = $request->name;
                $subject->code = $request->code;
                $subject->fm = $request->fm;
                $subject->credit_hour = $request->credit_hour;
                $subject->pm = $request->pm;
                $subject->exam_id = $exam->id;
                $subject->level_id = $request->level_id;
                $subject->section_id = $request->section_id;
                $subject->save();
                $partials = [];
                if ($request->filled('dis')) {
                    foreach ($request->dis as $key => $dis) {
                        $part_subject = new ExamSubjectParts();
                        $part_subject->name = $request->input('name_' . $dis);
                        $part_subject->code = $request->input('code_' . $dis);
                        $part_subject->pm = $request->input('pm_' . $dis);
                        $part_subject->credit_hour = $request->input('credit_hour_' . $dis);
                        $part_subject->fm = $request->input('fm_' . $dis);
                        $part_subject->exam_subject_id = $subject->id;
                        $part_subject->save();
                        array_push($partials, $part_subject);
                    }
                }
                $subject->partials = $partials;
                return response()->json($subject);
            } catch (\Throwable $th) {
                //throw $th;
                if ($subject->id != 0 && $subject->id != null) {
                    DB::table('exam_subjects')->where('exam_id', $exam->id)->delete();
                    $subject->delete();
                }
                throw $th;
            }
        }
    }


    public function del(Request $request, ExamSubject $subject)
    {
        if ($request->filled('pass')) {
            if (Hash::check($request->pass, Auth::user()->password)) {
                if (ExamMark::where('exam_subject_id', $subject->id)->count() > 0) {

                    if ($request->filled('stage')) {

                        foreach (ExamSubjectParts::where('exam_subject_id', $subject->id)->pluck('id') as $exam_subect_part_id) {
                            ExamMarkPart::where('exam_subject_part_id', $exam_subect_part_id)->delete();
                        }
                        ExamMark::where('exam_subject_id', $subject->id)->delete();
                        ExamSubjectParts::where('exam_subject_id', $subject->id)->delete();
                        $subject->delete();
                        return response()->json(['status' => true]);
                    } else {
                        return response()->json(['status' => false, 'msg' => "Marks already found for subect.Do you want delete all data?"]);
                    }
                } else {
                    ExamSubjectParts::where('exam_subject_id', $subject->id)->delete();
                    $subject->delete();
                    return response()->json(['status' => true]);
                }
            } else {
                return response()->json(['status' => false, 'msg' => "Wrong Password"]);
            }
        } else {
            throw new \Exception('Wrong Password');
        }
    }
    public function update(Request $request, ExamSubject $subject)
    {
        if ($request->getMethod() == "POST") {
            // return response()->json($request->all());
            // dd($request->all());
            try {
                //code...
                $subject->name = $request->name;
                $subject->code = $request->code;
                $subject->fm = $request->fm;
                $subject->pm = $request->pm;
                $subject->credit_hour = $request->credit_hour;
                $subject->save();
                $partials = [];
                if ($request->filled('dis')) {
                    foreach ($request->dis as $key => $dis) {
                        $part_subject = new ExamSubjectParts();
                        $part_subject->name = $request->input('name_' . $dis);
                        $part_subject->code = $request->input('code_' . $dis);
                        $part_subject->pm = $request->input('pm_' . $dis);
                        $part_subject->fm = $request->input('fm_' . $dis);
                        $part_subject->credit_hour = $request->input('credit_hour_' . $dis);
                        $part_subject->exam_subject_id = $subject->id;
                        $part_subject->save();
                    }
                }
                if ($request->filled('partial')) {
                    foreach ($request->partial as $key => $dis) {
                        $part_subject = ExamSubjectParts::where('id', $dis)->first();
                        $part_subject->name = $request->input('name_old_' . $dis);
                        $part_subject->code = $request->input('code_old_' . $dis);
                        $part_subject->credit_hour = $request->input('credit_hour_old_' . $dis);
                        $part_subject->pm = $request->input('pm_old_' . $dis);
                        $part_subject->fm = $request->input('fm_old_' . $dis);
                        $part_subject->exam_subject_id = $subject->id;
                        $part_subject->save();
                    }
                }

                return redirect()->back()->with('message', 'Exam Subject Updated Succesfully');
            } catch (\Throwable $th) {


                throw $th;
            }
        } else {
            return view('admin.exam.setup.edit', compact('subject'));
        }
    }

    public function delPartial(ExamSubjectParts $partial)
    {
        $partial->delete();
        return response()->json(['status' => true]);
    }

    public function mark(Request $request, ExamSubject $subject)
    {
        // $students_query=DB::table('student_registrations')
        // ->join('students','students.id','=','student_registrations.student_id')
        // ->where('student_registrations.level_id',$subject->level_id)
        // ->where('student_registrations.academic',$subject->level_id)

        if ($request->getMethod() == "POST") {

            $arr = [];
            $partials = $subject->partials;

            foreach ($request->students as $key => $sid) {
                $mark = ExamMark::where('exam_subject_id', $subject->id)->where('student_id', $sid)->first();
                if ($mark == null) {
                    $mark = new ExamMark();
                    $mark->exam_subject_id = $subject->id;
                    $mark->student_id = $sid;
                }

                if ($partials->count() == 0) {
                    $mark->marks = $request->input('s_' . $sid);
                    $mark->absent = $request->filled('a_' . $sid) ? 1 : 0;
                    $mark->per = ($mark->marks / $subject->fm) * 100;
                }
                $mark->save();



                if ($partials->count() > 0) {
                    $_marks = 0;
                    $_absent = 0;
                    foreach ($partials as $key => $partial) {
                        $mark_part = ExamMarkPart::where('exam_mark_id', $mark->id)->where('student_id', $sid)->where('exam_subject_part_id', $partial->id)->first();
                        if ($mark_part == null) {
                            $mark_part = new ExamMarkPart();
                            $mark_part->exam_mark_id = $mark->id;
                            $mark_part->exam_subject_part_id = $partial->id;
                            $mark_part->student_id = $sid;
                        }
                        $mark_part->marks = $request->input('sp_' . $sid . '_' . $partial->id);
                        $mark_part->absent = $request->filled('ap_' . $sid . '_' . $partial->id) ? 1 : 0;
                        $mark_part->per = ($mark_part->marks / $partial->fm) * 100;
                        $mark_part->save();
                        if ($mark_part->absent == 1) {
                            $_absent = 1;
                        }
                        $_marks += $mark_part->marks;
                    }
                    $mark->marks = $_marks;
                    $mark->absent = $_absent;
                    $mark->per = ($mark->marks / $subject->fm) * 100;
                    $mark->save();
                }
            }
            return response()->json();
        } else {
            $data = DB::selectOne('select 
            (select name from exams where id=' . $subject->exam_id . ') as exam_name,
            (select title from academic_years where id=(select academic_year_id from exams where id=' . $subject->exam_id . ')) as academic_year,
            (select title from levels where id=' . $subject->level_id . ') as level
            ' . ($subject->section_id != null ? (',(select title from sections where id=' . $subject->section_id . ') as section') : ''));
            $query = 'select s.name,s.id,sr.rollno from student_registrations sr join students s on sr.student_id=s.id where sr.academic_year_id=(select academic_year_id from exams where id=' . $subject->exam_id . ') and sr.level_id=' . $subject->level_id . ($subject->section_id != null ? (' and sr.section_id=' . $subject->section_id) : '');
            // dd($data,$query);
            $students = DB::select($query);
            // dd($data,$students,$query);
            // $_data=[];

            if ($subject->partials->count() > 0) {
                $data->marks = DB::table('exam_mark_parts')->join('exam_subject_parts', 'exam_subject_parts.id', '=', 'exam_mark_parts.exam_subject_part_id')
                    ->select(DB::raw('concat(\'sp_\',exam_mark_parts.student_id,\'_\',exam_subject_parts.id) as m_data,concat(\'ap_\',exam_mark_parts.student_id,\'_\',exam_subject_parts.id) as a_data,absent as a,marks as m'))->get();
                // $data->attendance=DB::table('exam_mark_parts')->join('exam_subject_parts','exam_subject_parts.id','=','exam_mark_parts.exam_subject_part_id')
                // ->select(DB::raw('concat(\'ap_\',exam_mark_parts.student_id,\'_\',exam_subject_parts.id) as data,absent as a'))->get();

            } else {
                $data->marks = DB::table('exam_marks')->join('exam_subjects', 'exam_subjects.id', '=', 'exam_marks.exam_subject_id')
                    ->select(DB::raw('concat(\'s_\',exam_marks.student_id) as m_data,concat(\'a_\',exam_marks.student_id) as a_data,absent as a,marks as m'))->get();
            }

            // dd($data->marks);

            return view('admin.exam.marks.index', compact('students', 'data', 'subject'));
        }
    }
}

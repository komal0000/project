<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AcademicYearController extends Controller
{
    public function index(){
        return view('admin.setting.academicyear.index',['years'=>AcademicYear::all()]);
    }

    public function add(Request $request){
        $request->validate([
            'title'=>'required',
            'start_date'=>'required|date',
            'end_date'=>'required|date',
        ]);
        $year=new AcademicYear();
        $year->title=$request->title;
        $year->start_date=$request->start_date;
        $year->end_date=$request->end_date;
        $year->is_open_for_admission=$request->is_open_for_admission??0;
        $year->status=$request->status??0;
        $year->save();

        return redirect()->back()->with('message','Academic Year Added Sucessfully');
    }

    public function update(Request $request){
        $request->validate([
            'id'=>'integer|required',
            'title'=>'required',
            'start_date'=>'required|date',
            'end_date'=>'required|date',
        ]);
        $year= AcademicYear::find($request->id);
        $year->title=$request->title;
        $year->start_date=$request->start_date;
        $year->end_date=$request->end_date;
        $year->is_open_for_admission=$request->is_open_for_admission??0;
        $year->status=$request->status??0;
        $year->save();

        return redirect()->back()->with('message','Academic Year Added Sucessfully');
    }

    public function delete(Request $request){
        $request->validate([
            'id'=>'integer|required',
        ]);
        $year= AcademicYear::find($request->id);
        $year->delete();
        return response()->json(['status'=>true]);
    }
}

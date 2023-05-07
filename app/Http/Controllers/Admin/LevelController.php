<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Level;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LevelController extends Controller
{
    public function index()
    {
        $levels=Level::all();
        $employees=DB::table('employees')->select('id','name')->where('type',0)->get();
        return view('admin.setting.level.index',compact('levels','employees'));
    }

    public function add(Request $request){
        $level=new Level();
        $level->title=$request->title;
        $level->employee_id=$request->employee_id==-1?null:$request->employee_id;
        $level->save();
        return redirect()->back()
        ->with('message',(env('iscollage',false)?"Program":"Level"). ' Added Sucessfully');
    }
    public function update(Request $request){
        $level=Level::find($request->id);
        $level->title=$request->title;
        $level->employee_id=$request->employee_id==-1?null:$request->employee_id;
        $level->save();
        return redirect()->back()->with('message',(env('iscollage',false)?"Program":"Level"). ' Updated Sucessfully');
    }

    public function delete(Request $request){
        $level=Level::find($request->id);
        $level->delete();
        return response()->json(['status'=>true]);
    }

    public function section(Level $level){
        $employees=DB::table('employees')->select('id','name')->where('type',0)->get();
        return view('admin.setting.level.section',compact('level','employees'));
    }

    public function sectionAdd(Request $request){
        $section=new Section();
        $section->level_id=$request->level_id;
        $section->title=$request->title;
        $section->employee_id=$request->employee_id==-1?null:$request->employee_id;
        $section->save();
        return redirect()->back()
        ->with('message',env('iscollage',false)?"Semester":"Section".' Added Sucessfully');
    }
    public function sectionUpdate(Request $request){
        $section=Section::find($request->id);
        $section->title=$request->title;
        $section->employee_id=$request->employee_id==-1?null:$request->employee_id;
        $section->save();
        return redirect()->back()->with('message',env('iscollage',false)?"Semester":"Section".' Updated Sucessfully');
    }

    public function sectionDelete(Request $request){
        $section=Section::find($request->id);
        $section->delete();
        return response()->json(['status'=>true]);
    }
}

<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    //
    public function info(Request $request)
    {
        if($request->getMethod()=="POST"){
            // $request->photo->store('uploads/tests');
            // dd($request->all());
            $year=Carbon::now()->year;
            $validator=Validator::make($request->all(),[
                'email'=>'required|email|exists:users,email',
                'name'=>'required',
                'block'=>'required',
                'phone'=>'required|regex:/9[7-8][0-9]{8}/',
                'photo'=>'image|required|max:500',
                'level_id'=>'required|exists:levels,id',
                'section_id'=>'required|exists:sections,id',
                'intake'=>'required|integer|between:1992,'.$year
            ],[
                'email.exists'=>'This email is not associated with any student',
                'phone.regex'=>'Please Enter Correct Phone Number',
                'image.max'=>'Image size should be less than 500kb',
                'level_id.exists'=>'Plese Select Your '.env('iscollage',false)?"Program":"Level",
                'section_id.exists'=>'Plese Select Your '.env('iscollage',false)?"Semester":"Section",
                'block.required'=>'Block / Street Address is Required'
            ]);
            if($validator->fails()){
                $errors=[];
                foreach ($validator->errors()->all() as $key => $value) {
            
                    array_push($errors,$value);
                }
                // dd($errors);
                return response()->json(['errors'=>$errors,'status'=>false]);
            }else{
                $user=User::where('email',$request->email)->first();
                if($user->token!=$request->token){
                    return response()->json(['errors'=>['Wrong Token'],'status'=>false]);
                }else{
                    $student=Student::where('user_id',$user->id)->first();
                    if($student==null){
                        $student=new Student();
                        $student->user_id=$user->id;
                    }
                    $student->email=$request->email;
                    $student->name=$request->name;
                    $student->phone=$request->phone;
                    $student->program=$request->level_id;
                    $student->semester=$request->section_id;
                    $student->intake=$request->intake;
                    $student->regno=$request->regno;
                    $student->gender=$request->gender;
                    $student->aadhar_no=$request->aadhar_no;
                    $student->country=$request->country;
                    $student->state=$request->state;
                    $student->district=$request->district;
                    $student->tehsil=$request->tehsil;
                    $student->block=$request->block;
                    $student->pin=$request->pin;
                    $student->confirmed=0;
                    $student->gaurdian_name="**";
                    $student->photo=$request->photo->store('uploads/students/'.$request->level_id);
                    $student->save();
                    $user->token=mt_rand(100000,999999);

                    $user->save();
                    return response()->json(['status'=>true]);
                }

            }
            
        }else{
            $data = DB::selectOne('select
            (select GROUP_CONCAT(id,concat(":",name)) from religions) as religions,
            (select GROUP_CONCAT(id,concat(":",name)) from religions) as religions,
            (select GROUP_CONCAT(id,concat(":",name)) from schemes) as schemes,
            (select GROUP_CONCAT(id,concat(":",name)) from categories) as categories,
            (select GROUP_CONCAT(id,concat(":",name)) from castes) as castes,  
            (select GROUP_CONCAT(id,concat(":",title)) from levels) as levels,
            (select GROUP_CONCAT(id,concat(":",level_id),concat(":",title)) from sections) as sections
           ');
           $token=$request->token??'';
           $name=$request->name??'';
           $email=$request->email??'';
            return view('student.info.index',compact('data','token','email','name'));
        }
    }

    public function show($email)
    {
        $student=DB::table('students')
        ->join('levels','levels.id','=','students.program')
        ->join('sections','sections.id','=','students.semester')
        ->where('email',$email)
        ->select(
            'students.id',
            'students.name',
            'students.block',
            'students.email',
            'students.phone',
            'students.photo',
            'students.gender',
            'students.regno',
            'students.intake',
            'levels.title as level',
            'sections.title as section')->first();
        if($student===null){
            abort(404);
        }
        // dd($email,$student);
        return view('student.info.show',compact('email','student'));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(){
        $employees=Employee::select('id','name','email','phone_no','designation','type')->get();
        return view('admin.employee.index',compact('employees'));
    }

    public function add(Request $request){
        if($request->getMethod()=="POST"){

            $user=new User();
            $user->name=$request->name;
            $user->email=$request->email;
            $user->password=bcrypt('employee');
            $user->save();

            $emp=new Employee();
            $emp->name=$request->name;
            $emp->phone_no=$request->phone_no;
            $emp->email=$request->email;
            $emp->dob=$request->dob;
            $emp->id_card='emp-'.$user->id;
            $emp->religion=$request->religion;
            $emp->gender=$request->gender;
            $emp->type=$request->type;
            $emp->designation=$request->designation;
            $emp->joining_date=$request->joining_date;
            $emp->shift=$request->shift;
            $emp->desc=$request->desc;
            $emp->qualification=$request->qualification;
            $emp->address=$request->address;
            $emp->user_id=$user->id;
            if($request->hasFile('photo')){
                $emp->photo=$request->photo->store('uploads/emp');
            }
            $emp->save();
            
            return redirect()->back()->with('message','Employee Added Sucessfully');
        }else{
            return view('admin.employee.add',['data'=>\App\Data::data]);
        }
    }

    public function update(Request $request,Employee $employee){
        if($request->getMethod()=="POST"){
            $employee->name=$request->name;
            $employee->phone_no=$request->phone_no;
            $employee->dob=$request->dob;
            $employee->email=$request->email;
            $employee->religion=$request->religion;
            $employee->gender=$request->gender;
            $employee->type=$request->type;
            $employee->designation=$request->designation;
            $employee->joining_date=$request->joining_date;
            $employee->shift=$request->shift;
            $employee->desc=$request->desc;
            $employee->qualification=$request->qualification;
            $employee->address=$request->address;
            if($request->hasFile('photo')){
                $employee->photo=$request->photo->store('uploads/emp');
            }
            $employee->save();

            $user=User::find($employee->user_id);
            if($user->email!=$employee->email){
                $user->email=$employee->email;
            }
            $user->name=$employee->name;
            $user->save();
            return redirect()->back()->with('message','Employee Updated Sucessfully');
        }else{
            return view('admin.employee.edit',['data'=>\App\Data::data,'employee'=>$employee]);
        }
    }

    public function delete(Request $request){
        $employee=Employee::find($request->id);
        $id=$employee->user_id;
        $employee->delete();
        $user=User::find($id);
        $user->delete();
        return response()->json(['status'=>true]);
    }

}

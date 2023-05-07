<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    //
    public function login(Request $request){
        if($request->getMethod()=="POST"){
            // dd($request->all());
            $data=$request->validate([
                'email'=>'email|required',
                'password'=>'required'
            ]);
            if(Auth::attempt(['email'=>$request->email,'password'=>$request->password,'role'=>1],$request->filled(('me')))){
                return redirect()->route('admin.dashboard.index')->with('message',"Login Sucessfull");
            }else{
                return redirect()->back()
                ->with('error','Email and password Combination Wrong.')
                ->withInput(['email']);
            }
        }else{
            return view('admin.auth.login');
        }
    }

    public function email(Request $request){
        $free=1;
        if($request->filled('emp_id')){
            $employee=Employee::select('email')->where('id',$request->emp_id)->first();
            if($employee->email==$request->email){
                $free=0;
            }else{
                $free=DB::table('users')->where('email',$request->email)->count();
            }
        }else{
            $free=DB::table('users')->where('email',$request->email)->count();
        }
        return response()->json(['status'=>$free]);
    }
}

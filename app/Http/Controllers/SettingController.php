<?php

namespace App\Http\Controllers;

use App\Models\Caste;
use App\Models\Category;
use App\Models\Religion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function caste(Request $request){
        // $path=storage_path('data.json');
        if($request->getMethod()=="POST"){
            if($request->type==1){
                $caste=new Caste();
                $caste->name=$request->name;
                $caste->save();
                return redirect()->back()->with('message','Caste Saved Sucessfully');
            }elseif($request->type==2){
                $caste=Caste::find($request->id);
                $caste->name=$request->name;
                $caste->save();
                return redirect()->back()->with('message','Caste Saved Sucessfully');
            }elseif($request->type==3){
                $caste=Caste::find($request->id);
                $caste->delete();
                return response('ok');
            }
        }else{
            // $data=DB::select('select (select id from categories) as categories');
            // dd($data);
            $data=Caste::all();
            return view('admin.setting.data.caste',compact('data'));
        }
    }

    public function category(Request $request){
        // $path=storage_path('data.json');
        if($request->getMethod()=="POST"){
            if($request->type==1){
                $category=new Category();
                $category->name=$request->name;
                $category->desc=$request->desc;
                $category->reserved=$request->reserved??0;
                $category->save();
                return redirect()->back()->with('message','Category Saved Sucessfully');
            }elseif($request->type==2){
                $category=Category::find($request->id);
                $category->name=$request->name;  
                $category->desc=$request->desc;
                $category->reserved=$request->reserved??0;
                $category->save();
                return redirect()->back()->with('message','Category Saved Sucessfully');
            }elseif($request->type==3){
                $category=Category::find($request->id);
                $category->delete();
                return response('ok');
            }
        }else{
            // $data=DB::select('select (select id from categories) as categories');
            // dd($data);
            $data=Category::all();
            return view('admin.setting.data.category',compact('data'));
        }
    }

    public function religion(Request $request){
        // $path=storage_path('data.json');
        if($request->getMethod()=="POST"){
            if($request->type==1){
                $religion=new Religion();
                $religion->name=$request->name;
                $religion->save();
                return redirect()->back()->with('message','Religion Saved Sucessfully');
            }elseif($request->type==2){
                $religion=Religion::find($request->id);
                $religion->name=$request->name;
                $religion->save();
                return redirect()->back()->with('message','Religion Saved Sucessfully');
            }elseif($request->type==3){
                $religion=Religion::find($request->id);
                $religion->delete();
                return response('ok');
            }
        }else{
            // $data=DB::select('select (select id from categories) as categories');
            // dd($data);
            $data=Religion::all();
            return view('admin.setting.data.religion',compact('data'));
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Download;
use App\Models\DownloadType;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DownloadController extends Controller
{

    //types
    public function indexType()
    {
        $types=DownloadType::where('parent_id',0)->with('childs')->get(['id','name']);
        // dd($types);
        return view('admin.download.type',compact('types'));
    }

    public function addType(Request $request){
        $type=new DownloadType();
        $type->name=$request->name;
        $type->parent_id=$request->parent_id??0;
        $type->save();
        return redirect()->back()->with('message','Download Type Added Sucessfully');
    }
    public function editType(Request $request,DownloadType $type){
        $type->name=$request->name;

        $type->save();
        // dd($type);
        return redirect()->back()->with('message','Download Type Updated Sucessfully');
    }

    public function delType(Request $request,DownloadType $type){
        if($type->hasDownload()){
            return redirect()->back()->with('message','Cannot Delete  Download Type.');

        }else{

            if($type->parent_id==0){
                DownloadType::where('parent_id',$type->id)->update(['parent_id'=>0]);
            }
            $type->delete();
           
            return redirect()->back()->with('message','Download Type Deleted Sucessfully');
        }
    }

    public function index(DownloadType $type){
        return view('admin.download.index',compact('type'));
    }

    public function add(Request $request)
    {
        $path='uploads/download/'.Carbon::now()->format('Y/m/d');

        $data=$request->except('_token');
        $data['file']=$data['file']->store($path);
        $download=Download::create($data);
        return response()->json($download);
    }

    function del(Download $download){
        $d=$download;
        $download->delete();
        return response()->json($d);
    }
}

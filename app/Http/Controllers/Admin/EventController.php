<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event as ModelsEvent;
use Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    //
    public function index()
    {
        $events=DB::table('events')->get(['id','title']);
        return view('admin.event.index',compact('events'));
    }

    public function add(Request $request){
        if($request->getMethod()=="POST"){
            $event=new ModelsEvent();
            $event->title=$request->title;
            $event->addr=$request->addr;
            $event->short_desc=$request->short_desc??'';
            $event->desc=$request->desc??'';
            $event->start=$request->start;
            $event->end=$request->end;
            $event->start_time=$request->start_time;
            $event->end_time=$request->end_time;
            $event->image=$request->photo->store('uploads/events');
            $event->save();
            return redirect()->back()->with('message','Event Updated Successfullly');
        }else{
            return view('admin.event.add');
        }
    }
    public function edit(Request $request,ModelsEvent $event){
        if($request->getMethod()=="POST"){
            $event->title=$request->title;
            $event->addr=$request->addr;
            $event->short_desc=$request->short_desc??'';
            $event->desc=$request->desc??'';
            $event->start=$request->start;
            $event->end=$request->end;
            $event->start_time=$request->start_time;
            $event->end_time=$request->end_time;
            if($request->hasFile('photo')){
                $event->image=$request->photo->store('uploads/events');
            }
            $event->save();
            return redirect()->back()->with('message','Event Updated Successfullly');
        }else{
            return view('admin.event.edit',compact('event'));
        }
    }
    public function del(Request $request,ModelsEvent $event){
        $event->delete();
        return redirect()->back()->with('message','Event Delete Successfullly');

    }
}


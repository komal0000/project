<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SliderController extends Controller
{
    public function index()
    {

        $sliders=DB::table('sliders')->get();
        return view('admin.setting.slider.index',compact('sliders'));
    }

    public function add(Request $request)
    {
        if($request->getMethod()=="POST"){
            $slider=new Slider();
            $slider->title=$request->title??'';
            $slider->subtitle=$request->subtitle??'';
            $slider->link_title=$request->link_title??'';
            $slider->fg=$request->fg??"";
            $slider->bg=$request->bg??"";
            $slider->image=$request->image->store('uploads/sliders');
            if($request->hasFile('mobile_image')){
                $slider->mobile_image=$request->mobile_image->store('uploads/sliders');

            }else{
                $slider->mobile_image=$slider->image;

            }
            $slider->link ="";

            $slider->save();
            $this->render();
            return redirect()->back()->with('message','Slider Added');
            // dd($request->all(),$slider);
        }else{
            $pages = DB::table('pages')->select('id', 'type', 'title')->get();
            return view('admin.setting.slider.add',compact('pages'));

        }
    }

    public function del(Request $request,Slider $slider)
    {
        $slider->delete();
        $this->render();

        return redirect()->back()->with('message','Slider Deleted');

    }
    public function edit(Request $request,Slider $slider)
    {
        if($request->getMethod()=="POST"){
            $slider->title=$request->title;
            $slider->subtitle=$request->subtitle;

            if($request->hasFile('image')){
                $slider->image=$request->image->store('uploads/sliders');
                $slider->mobile_image=$slider->image;

            }

            $slider->save();
            $this->render();
            return redirect()->back()->with('message','Slider Updated');
            // dd($request->all(),$slider);
        }else{
            $pages = DB::table('pages')->select('id', 'type', 'title')->get();
            return view('admin.setting.slider.edit',compact('pages','slider'));

        }
    }

    private function render()
    {
        $sliders=DB::table('sliders')->get();

        file_put_contents(resource_path('views/front/pages/template/slider.blade.php'),view('admin.setting.slider.template',compact('sliders'))->render());
    }
}

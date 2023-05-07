<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FaqController extends Controller
{
    //

    public function index()
    {
        $faqs=DB::table('faqs')->get(['id','q']);
        return view('admin.faq.index',compact('faqs'));
    }

    public function add(Request $request)
    {
        if($request->getMethod()=="GET"){
            return view('admin.faq.add');
        }else{
            $faq=new Faq();
            $faq->a=$request->a;
            $faq->q=$request->q;
            $faq->save();
            $this->render();

            return response()->json(['status'=>true]);
        }
    }
    public function edit(Faq $faq,Request $request)
    {
        if($request->getMethod()=="GET"){
            return view('admin.faq.edit',compact('faq'));
        }else{
            $faq->a=$request->a;
            $faq->q=$request->q;
            $faq->save();
            $this->render();
            return response()->json(['status'=>true]);
        }
    }

    public function del(Faq $faq,Request $request)
    {
        $faq->delete();
        $this->render();

        return redirect()->back()->with('message','Faq Deleted Sucessfully');
    }

    public function render()
    {
        $faqs=Faq::all();

        file_put_contents(resource_path('views/front/pages/partials/faq.blade.php'), view('admin.faq.template',compact('faqs'))->render());

    }
}

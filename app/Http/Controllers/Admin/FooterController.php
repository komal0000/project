<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function index(Request $request)
    {
        if($request->getMethod()=="POST"){
            $footer1=[
                'desc'=>$request->desc,
                'title'=>$request->title,
                'links'=>[]
            ];
            $footer2=[];
            $footer3=[];
            if($request->has('footer1')){
                foreach ($request->footer1 as $key => $value) {
                    array_push($footer1['links'],[
                        'title'=>$request->input('title_'.$value),
                        'link'=>$request->input('link_'.$value)
                    ]);
                }                
            }
            setSetting('footer1',$footer1);


            //set Footer 2
            if($request->has('footer2')){
                foreach ($request->footer2 as $key => $value) {
                    array_push($footer2,[
                        'title'=>$request->input('title_'.$value),
                        'link'=>$request->input('link_'.$value)
                    ]);
                }                
            }
            setSetting('footer2',$footer2);

            //set Footer 3
            if($request->has('footer3')){
                foreach ($request->footer3 as $key => $value) {
                    array_push($footer3,[
                        'title'=>$request->input('title_'.$value),
                        'link'=>$request->input('link_'.$value)
                    ]);
                }                
            }
            setSetting('footer3',$footer3);
            setSetting('footer4',$request->footer4,true);
            $this->render();
            return redirect()->back()->with('message','Footer Updated');
            // dd($request->all(),$footer1);
        }else{
                $footer1=getSetting('footer1')??(object)["desc"=>'','links'=>[],'title'=>''];
                // dd($footer1);
                $footer2=getSetting('footer2')??[];
                $footer3=getSetting('footer3')??[];
                $footer4=getSetting('footer4',true)??'';
                return view('admin.setting.footer',compact('footer1','footer2','footer3','footer4'));
        }
    }

    private function render()
    {
        $footer1=getSetting('footer1')??(object)["desc"=>'','links'=>[],'title'=>''];
        // dd($footer1);
        $footer2=getSetting('footer2')??[];
        $footer3=getSetting('footer3')??[];
        $footer4=getSetting('footer4',true)??'';
        file_put_contents(resource_path('views/front/layout/footer.blade.php'),view('admin.setting.template.footer',compact('footer1','footer2','footer3','footer4'))->render());
    }
}

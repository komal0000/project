<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataController extends Controller
{
    public function classes(){
        $levels=DB::table('levels')->get(['id','title']);
        foreach ($levels as $key => $level) {
            $level->semesters=DB::table('sections')->where('level_id',$level->id)->get(['id','title']);
        }
        return response()->json(['levels'=>$levels,'ays'=>DB::table('academic_years')->get(['id','title'])]);
    }

    public function getStudent(Request $request){
        $query=DB::table('students')->where('program', $request->l_id)->where('intake',$request->intake);
        if($request->filled('s_id')){   
                $query= $query->where('semester', $request->s_id);
        }

        return response()->json([
            'students' => $query->get(['id', 'name', 'photo', 'block', 'email', 'phone', 'confirmed','intake'])
        ]);
    }
}

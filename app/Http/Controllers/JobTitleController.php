<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Types_of_jobs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobTitleController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');

    }


    public function datatable(){
        $data=Types_of_jobs::get();
        if($data->count() >0){
            return response()->json([
                'data'=>$data,
                'message'=>'found data'
            ]);

        }else{
            return response()->json([
                'data'=>$data,
                'message'=>'notfound data'
            ]);

        }
    }
    public function create(){

        return view('types_of_jobs.create');
    }
    public function store(Request $request){
        $dataval=$request->validate([
            'job_title'=>'required|string|max:255'
        ]);
        $data=new Types_of_jobs();
        $data->title=$dataval['job_title'];
        $data->save();
        return redirect()->back()->with('message','تمت إضافة المسمى الوظيفي الجديد بنجاح');

    }
    public function update(Request $request,$id){
        $data=Types_of_jobs::where('id','=',$id)->first();

        if($data){
            $dataval=$request->validate([
                'job_title'=>'required|string|max:255'
            ]);
            try {
                $data->title=$dataval['job_title'];
                $data->update();
                return redirect()->back()->with('message','تم تحديث المسمى الوظيفي بنجاح');

            } catch (\Throwable $th) {

                return redirect()->back()->with('error','آسف يرجى المحاولة مرة أخرى');


            }


        }else{
            return redirect()->back()->with('error','not found');

        }
    }
}

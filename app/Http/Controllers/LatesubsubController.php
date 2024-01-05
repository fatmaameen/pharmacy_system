<?php

namespace App\Http\Controllers;

use App\Models\Latesubcatg;
use App\Models\Latesubsub;
use Illuminate\Http\Request;

class LatesubsubController extends Controller
{
    public function index()
    {
        $subsubcatg=Latesubsub::all();
        $subcatg=Latesubcatg::all();

        return view('late_subsubcatg.index',compact('subcatg' ,'subsubcatg'));

    }

    public function create()
    {
        try {
          $subcatg=Latesubcatg::all();
        return view('late_subsubcatg.create' ,compact('subcatg'));



        } catch (\Throwable $th) {
                 return redirect()->back()->with('error', 'اسف يرجي المحاولة مرة اخري');

        }

    }
    public function store(Request $request)
    {


        $dataval = $request->validate([
            'name' => 'required|max:300|string',
            'leader' => 'required|max:300|string',
            'phone_subsubcatg' => 'min:10|max:15|required',
            'number_employee' => 'required|numeric|min:1',
            'email' => 'required|email',

            'subcategory_id'=>'required'
        ]);



                    $data = new Latesubsub();
                    $data->name = $dataval['name'];
                    $data->leader = $dataval['leader'];
                    $data->phone_subsubcatg = $dataval['phone_subsubcatg'];
                    $data->number_employee = $dataval['number_employee'];
                    $data->email = $dataval['email'];
                    $data->subcategory_id = $dataval['subcategory_id'];
                    $data->save();
                    return redirect()->route('late_subsubcategories.index')->with('message', 'تمت إضافة فئات فرعية جديدة للفئات الفرعية الموجودة بنجاح');

    }
    public function edit($id)
    {
        try {
           $subsubcatg=Latesubsub::where('id' ,$id)->first();
           $subcatg=Latesubcatg::all();
                return view('late_subsubcatg.edit', compact('subcatg' ,'subsubcatg'));




        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'sorry please try again');

        }
     }
     public function update(Request $request, $id)
     {

         $data = Latesubsub::where('id', '=', $id)->first();
         $dataval = $request->validate([
             'name' => 'required|max:300|string' ,
             'leader' => 'required|max:300|string',
             'phone_subsubcatg' => 'min:10|max:15|required',
             'number_employee' => 'required|numeric|min:1',
             'email' => 'required|email',
             'subcatg'=>'required'
         ]);

         try {

                  $data->name = $dataval['name'];
                    $data->leader = $dataval['leader'];
                    $data->phone_subsubcatg = $dataval['phone_subsubcatg'];
                    $data->number_employee = $dataval['number_employee'];
                    $data->email = $dataval['email'];
                  $data->subcategory_id=$dataval['subcatg'];
         $data->update();
         return redirect()->back()->with('message', 'تم تعديل بيانات القسم بنجاح');

     } catch (\Throwable $th) {
         return redirect()->back()->with('error', 'آسف يرجى المحاولة مرة أخرى');

     }
     }
}

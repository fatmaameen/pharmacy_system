<?php

namespace App\Http\Controllers;

use App\Models\NigthSubCatg;
use App\Models\NigthSunsubCatg;
use Illuminate\Http\Request;

class Nigthsubsubcatg extends Controller
{
    public function index()
    {
        $subsubcatg=NigthSunsubCatg::all();
        $subcatg=NigthSubCatg::all();

        return view('nigth_subsubcatg.index',compact('subcatg' ,'subsubcatg'));

    }

    public function create()
    {
        try {
          $subcatg=NigthSubCatg::all();
        return view('nigth_subsubcatg.create' ,compact('subcatg'));



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



                    $data = new NigthSunsubCatg();
                    $data->name = $dataval['name'];
                    $data->leader = $dataval['leader'];
                    $data->phone_subsubcatg = $dataval['phone_subsubcatg'];
                    $data->number_employee = $dataval['number_employee'];
                    $data->email = $dataval['email'];
                    $data->subcategory_id = $dataval['subcategory_id'];
                    $data->save();
                    return redirect()->route('nigth_subsubcategories.index')->with('message', 'تمت إضافة فئات فرعية جديدة للفئات الفرعية الموجودة بنجاح');

    }
    public function edit($id)
    {
        try {
           $subsubcatg=NigthSunsubCatg::where('id' ,$id)->first();
           $subcatg=NigthSubCatg::all();
                return view('nigth_subsubcatg.edit', compact('subcatg' ,'subsubcatg'));




        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'sorry please try again');

        }
     }
     public function update(Request $request, $id)
     {

         $data = NigthSunsubCatg::where('id', '=', $id)->first();
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

<?php

namespace App\Http\Controllers;

use App\Models\SubCategories_Store;
use App\Models\SubSubCategory;
use Illuminate\Http\Request;

class SubSubCategoriesController extends Controller
{


    public function index()
    {
        $subsubcatg=SubSubCategory::all();
        $subcatg=SubCategories_Store::all();

        return view('subsubcat.index',compact('subcatg' ,'subsubcatg'));

    }

    public function create()
    {
        try {
          $subcatg=SubCategories_Store::all();
        return view('subsubcat.create' ,compact('subcatg'));



        } catch (\Throwable $th) {
                 return redirect()->back()->with('error', 'sorry please try again');

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



                    $data = new SubSubCategory();
                    $data->name = $dataval['name'];
                    $data->leader = $dataval['leader'];
                    $data->phone_subsubcatg = $dataval['phone_subsubcatg'];
                    $data->number_employee = $dataval['number_employee'];
                    $data->email = $dataval['email'];
                    $data->subcategory_id = $dataval['subcategory_id'];
                    $data->save();
                    return redirect()->route('subsubcategories.index')->with('message', 'تمت إضافة فئات فرعية جديدة للفئات الفرعية الموجودة بنجاح');

    }
    public function edit($id)
    {
        try {
           $subsubcatg=SubSubCategory::where('id' ,$id)->first();
           $subcatg=SubCategories_Store::all();
                return view('subsubcat.edit', compact('subcatg' ,'subsubcatg'));




        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'sorry please try again');

        }
     }
     public function update(Request $request, $id)
     {

         $data = SubSubCategory::where('id', '=', $id)->first();
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


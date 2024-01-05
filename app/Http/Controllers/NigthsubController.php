<?php

namespace App\Http\Controllers;

use App\Models\NigthCatg;
use App\Models\NigthSubCatg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NigthsubController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');

    }



    public function index()
    {
        $subcatg=NigthSubCatg::all();
        $catgories=NigthCatg::all();

        return view('nigth_subcatg.index',compact('subcatg' ,'catgories'));

    }


    // public function status(Request $request)
    // {

    //     $dataval = $request->validate([
    //         'id' => 'required|exists:subcategories_store,id'
    //     ]);
    //    // $data = Catagories_Store::where('company_id', '=', auth()->user()->company_id)->where('id', '=', $dataval['id'])->first();
    //    $data=SubCategories_Store::find($dataval['id']);



    //         if ($data->status == 1) {
    //             $data->status = 0;
    //             $data->update();
    //             return response()->json([
    //                 'message' => 'done update status',
    //                 'status' => '200',
    //                 'data1'=>$data,

    //             ]);
    //         } else {
    //             $data->status = 1;
    //             $data->update();
    //             return response()->json([
    //                 'message' => 'done update status',
    //                 'status' => '200',
    //                 'data1'=>$data,

    //             ]);
    //         }

    // }

    public function create()
    {
        try {

       $categories=NigthCatg::all();
       return view('nigth_subcatg.create' ,compact('categories'));

            }


         catch (\Throwable $th) {
                 return redirect()->back()->with('error', 'sorry please try again');

        }

    }

    public function store(Request $request)
    {
        $dataval = $request->validate([
            'name' => 'required|max:300|string',
            'leader' => 'required|max:300|string',
            'phone_subcatg' => 'min:10|max:15|required',
            'number_employee' => 'required|numeric|min:1',
            'email' => 'required|email',
            'category_id' => 'required',
        ]);


        try{
                    $data = new NigthSubCatg();
                    $data->name = $dataval['name'];
                    $data->leader = $dataval['leader'];
                    $data->phone_subcatg = $dataval['phone_subcatg'];
                    $data->number_employee = $dataval['number_employee'];
                    $data->email = $dataval['email'];
                    $data->category_id =$dataval['category_id'] ;
                    $data->save();

               return redirect()->route('nigth_subcategories.index')->with('massage' ,'تم اضافة القسم الفرعي بنجاح');
                }


    catch (\Throwable $th) {
        return redirect()->back()->with('error', 'آسف يرجى المحاولة مرة أخرى');

 }
}

    public function edit($id)
    {
        try {
           $subcatg=NigthSubCatg::where('id' ,$id)->first();
           $categories=NigthCatg::all();
                return view('nigth_subcatg.edit', compact('subcatg' ,'categories'));




        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'sorry please try again');

        }
     }
    public function update(Request $request, $id)
    {

        $data = NigthSubCatg::where('id', '=', $id)->first();
        $dataval = $request->validate([
            'name' => 'required|max:300|string',
            'leader' => 'required|max:300|string',
            'phone_subcatg' => 'min:10|max:15|required',
            'number_employee' => 'required|numeric|min:1',
            'email' => 'required|email',
            'category_id' => 'required',
        ]);
        try {

        $data->name = $dataval['name'];
        $data->leader = $dataval['leader'];
        $data->phone_subcatg = $dataval['phone_subcatg'];
        $data->number_employee = $dataval['number_employee'];
        $data->email = $dataval['email'];
        $data->category_id=$dataval['category_id'];
        $data->update();
        return redirect()->back()->with('message', 'تم تعديل بيانات القسم بنجاح');

    } catch (\Throwable $th) {
        return redirect()->back()->with('error', 'آسف يرجى المحاولة مرة أخرى');

    }
    }
    public function show_subsub($id){

        $subsubcatg=DB::table("nigth_subsubcategory")->where("subcategory_id" ,$id)->get();
        $subcatg=NigthSubCatg::where('id' ,$id)->first();
        return view('nigth_subsubcatg.show_subsub' ,compact('subcatg' ,'subsubcatg'));
        }
}



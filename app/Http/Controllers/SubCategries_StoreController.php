<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubCategories_Store;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use App\Models\Catagories_Store;
use App\Models\types_store;
use Illuminate\Support\Facades\DB;

class SubCategries_StoreController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');

    }



    public function index()
    {
        $subcatg=SubCategories_Store::all();
        $catgories=Catagories_Store::all();

        return view('subcat.index',compact('subcatg' ,'catgories'));

    }

    public function datatable($id)
    {
          //  $data = SubCategories_Store::select(['id', 'name_ar as name', 'logo', 'status', 'created_at'])->where('category_id', '=', $id)->get();

            $data =DB::table('categories')
            ->join('subcategories_store','categories.id','=','subcategories_store.category_id')
            ->where('categories.id','=',$id)
            ->select(['subcategories_store.name as name','subcategories_store.id','subcategories_store.status','subcategories_store.created_at'])
            ->get();

        if ($data) {
            return response()->json([
                'data' => $data,
                'message' => 'true'
            ]);
        } else {
            return response()->json([

                'message' => 'false'
            ]);
        }
    }

    public function status(Request $request)
    {

        $dataval = $request->validate([
            'id' => 'required|exists:subcategories_store,id'
        ]);
       // $data = Catagories_Store::where('company_id', '=', auth()->user()->company_id)->where('id', '=', $dataval['id'])->first();
       $data=SubCategories_Store::find($dataval['id']);



            if ($data->status == 1) {
                $data->status = 0;
                $data->update();
                return response()->json([
                    'message' => 'done update status',
                    'status' => '200',
                    'data1'=>$data,

                ]);
            } else {
                $data->status = 1;
                $data->update();
                return response()->json([
                    'message' => 'done update status',
                    'status' => '200',
                    'data1'=>$data,

                ]);
            }

    }

    public function create()
    {
        try {

       $categories=Catagories_Store::all();
       return view('subcat.create' ,compact('categories'));

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
                    $data = new SubCategories_Store();
                    $data->name = $dataval['name'];
                    $data->leader = $dataval['leader'];
                    $data->phone_subcatg = $dataval['phone_subcatg'];
                    $data->number_employee = $dataval['number_employee'];
                    $data->email = $dataval['email'];
                    $data->category_id =$dataval['category_id'] ;
                    $data->save();

               return redirect()->route('subcategories.index')->with('massage' ,'تم اضافة القسم الفرعي بنجاح');
                }


    catch (\Throwable $th) {
        return redirect()->back()->with('error', 'آسف يرجى المحاولة مرة أخرى');

 }
}

    public function edit($id)
    {
        try {
           $subcatg=SubCategories_Store::where('id' ,$id)->first();
           $categories=Catagories_Store::all();
                return view('subcat.edit', compact('subcatg' ,'categories'));




        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'sorry please try again');

        }
     }
    public function update(Request $request, $id)
    {

        $data = SubCategories_Store::where('id', '=', $id)->first();
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

        $subsubcatg=DB::table("subsubcategories_store")->where("subcategory_id" ,$id)->get();
        $subcatg=SubCategories_Store::where('id' ,$id)->first();
        return view('subsubcat.show_subsub' ,compact('subcatg' ,'subsubcatg'));
        }
}

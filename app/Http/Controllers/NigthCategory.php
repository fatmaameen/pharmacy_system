<?php

namespace App\Http\Controllers;

use App\Models\NigthCatg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NigthCategory extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');

    }

    public function index()
    {
        $categories=NigthCatg::all();
        return view('nigthcategory.index' ,compact('categories'));
    }




    public function create()
    {

        return view('nigthcategory.create');
    }

    public function store(Request $request)
    {
        try {

        $validatedData = $request->validate([
            'name' => 'required|max:300|string|unique:nigth_category,name',
            'leader' => 'required|max:300|string',
            'phone_catg' => 'min:10|max:15|required',
            'number_employee' => 'required|numeric|min:1',
            'email' => 'required|email',
        ], [
            'name.required' => 'حقل الاسم مطلوب',

        ]);

        $category = new NigthCatg();
        $category->name = $validatedData['name'];
        $category->leader = $validatedData['leader'];
        $category->phone_catg = $validatedData['phone_catg'];
        $category->number_employee = $validatedData['number_employee'];
        $category->email = $validatedData['email'];

        $category->save();


       return redirect()->route('nigth_categories.index')->with('message', 'تمت إضافة قسم جديد بنجاح');

    } catch (\Throwable $th) {
        return redirect()->back()->with('error', 'آسف يرجى المحاولة مرة أخرى');

    }
    }



    public function edit($id)
    {
        $category = NigthCatg::where('id', '=', $id)->first();
        return view('nigthcategory.edit', ['data' => $category, 'id' => $id]);
    }


    public function update(Request $request, $id)
    {

        $data = NigthCatg::where('id', '=', $id)->first();

        $dataval = $request->validate([
            'name' => 'required|max:300|string',
            'leader' => 'required|max:300|string',
            'phone_catg' => 'min:10|max:15|required',
            'number_employee' => 'required|max:300|numeric|min:1',
            'email' => 'required|email',

        ]);
        try {


        $data->name = $dataval['name'];
        $data->leader = $dataval['leader'];
        $data->phone_catg = $dataval['phone_catg'];
        $data->number_employee = $dataval['number_employee'];
        $data->email = $dataval['email'];
        $data->update();
        return redirect()->route('nigth_categories.index')->with('message', 'تم تعديل بيانات القسم  بنجاح');

    } catch (\Throwable $th) {
        return redirect()->back()->with('error', 'آسف يرجى المحاولة مرة أخرى');

    }

    }
public function get_subcategory($id){

$subcategory = DB::table("nigth_subcategory")->where("category_id" ,$id)->pluck("name" ,"id");
return json_encode($subcategory);
}
public function get_subsubcategory($id){

    $subsubcategory=DB::table("nigth_subsubcategory")->where("subcategory_id" ,$id)->pluck("name" ,"id");
    return json_encode($subsubcategory);

    }


    public function show_sub($id){

        $subcatg=DB::table("nigth_subcategory")->where("category_id" ,$id)->get();
        $catg=NigthCatg::where('id' ,$id)->first();
        return view('nigthcategory.show_sub' ,compact('subcatg' ,'catg'));
        }
}

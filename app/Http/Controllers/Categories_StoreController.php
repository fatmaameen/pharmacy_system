<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Catagories_Store;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;


class Categories_StoreController extends Controller
{


    public function __construct()
    {
        $this->middleware('admin');

    }

    public function index()
    {
        $categories=Catagories_Store::all();
        return view('category.index' ,compact('categories'));
    }

    public function shifts()
    {

        return view('category.shifts');
    }
    public function pages()
    {

        return view('category.pages');
    }
    public function nigth()
    {

        return view('category.nigth');
    }

    public function late()
    {

        return view('category.late');
    }
    public function create()
    {

        return view('category.create');
    }

    public function store(Request $request)
    {
        try {

        $validatedData = $request->validate([
            'name' => 'required|max:300|string|unique:categories,name',
            'leader' => 'required|max:300|string',
            'phone_catg' => 'min:10|max:15|required',
            'number_employee' => 'required|numeric|min:1',
            'email' => 'required|email',
        ], [
            'name.required' => 'حقل الاسم مطلوب',

        ]);

        $category = new Catagories_Store();
        $category->name = $validatedData['name'];
        $category->leader = $validatedData['leader'];
        $category->phone_catg = $validatedData['phone_catg'];
        $category->number_employee = $validatedData['number_employee'];
        $category->email = $validatedData['email'];

        $category->save();


       return redirect()->route('categories.index')->with('message', 'تمت إضافة قسم جديد بنجاح');

    } catch (\Throwable $th) {
        return redirect()->back()->with('error', 'آسف يرجى المحاولة مرة أخرى');

    }
    }



    public function edit($id)
    {
        $category = Catagories_Store::where('id', '=', $id)->first();
        return view('category.edit', ['data' => $category, 'id' => $id]);
    }


    public function update(Request $request, $id)
    {

        $data = Catagories_Store::where('id', '=', $id)->first();

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
        return redirect()->route('categories.index')->with('message', 'تم تعديل بيانات القسم  بنجاح');

    } catch (\Throwable $th) {
        return redirect()->back()->with('error', 'آسف يرجى المحاولة مرة أخرى');

    }

    }
public function get_subcategory($id){

$subcategory=DB::table("subcategories_store")->where("category_id" ,$id)->pluck("name" ,"id");
return json_encode($subcategory);
}
public function get_subsubcategory($id){

    $subsubcategory=DB::table("subsubcategories_store")->where("subcategory_id" ,$id)->pluck("name" ,"id");
    return json_encode($subsubcategory);

    }


    public function show_sub($id){

        $subcatg=DB::table("subcategories_store")->where("category_id" ,$id)->get();
        $catg=Catagories_Store::where('id' ,$id)->first();
        return view('category.show_sub' ,compact('subcatg' ,'catg'));
        }
}

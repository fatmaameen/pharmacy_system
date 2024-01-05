<?php

namespace App\Http\Controllers;

use App\Models\Nigth_supplier_withproduct;
use App\Models\User;
use App\Models\Stock;
use App\Models\units;
use App\Models\Products;
use App\Traits\ImageTrait;
use App\Models\Raw_Materia;
use App\Models\Payment_Type;
use App\Models\stores_ready;
use Illuminate\Http\Request;
use App\Models\SubSubCategory;
use App\Models\Suppliers_store;
use App\Models\Catagories_Store;
use App\Models\Order_Raw_Material;
use App\Models\Store_Raw_Material;
use App\Models\Suppliers_Medicine;
use App\Notifications\add_product;
use Illuminate\Support\Facades\DB;
use App\Models\SubCategories_Store;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use App\Models\NigthCatg;
use App\Models\NigthProduct;
use App\Models\NigthStock_table;
use App\Models\NigthSubCatg;
use App\Models\NigthSunsubCatg;
use App\Models\Supplier_withproduct;
use Illuminate\Support\Facades\Hash;
use App\Models\Raw_Material_Categories;
use App\Models\Raw_Material_Subcategories;
use App\Models\Shifts;
use Illuminate\Notifications\Notification;
use  Darryldecode\Cart\Facades\CartFacade as Cart;
use App\Models\Transactions_Store_Raw_Material_Requerd;

class Raw_MaterialController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');

    }


    public function __invoke(Request $request)
    {
        $term = $request->query('term', '');
        $data = Products::search($term)->paginate();
        logger($data);
        if ($request->ajax()) {
            return view('product.index', compact('data'));
        }

        return view('product.index', compact('data'));
    }




    public function index($id)
    {

        $data=DB::table('products')->where('subsubcatg', '=', $id)->get();

        if ($data) {
            return view( 'product.index' ,compact('data'));

        }



    }
    public function nigth_index($id)
    {

        $data=DB::table('nigth_products')->where('nigth_subsubcatg', '=', $id)->get();

        if ($data) {
            return view( 'nigth_product.index' ,compact('data'));

        }



    }
    public function shifts()
    {
            return view( 'product.shifts');

    }
    public function datatable($id)
    {
        try {
            $check = SubCategories_Store::where('id', '=', $id)
                ->first();
            if ($check) {





                    $data=DB::table('medicine')
                    ->join('subcategories_store','medicine.category_id','=','subcategories_store.id')
                    ->where('medicine.category_id', '=', $id)
                    ->select('medicine.*')
                    ->get();





                    if ($data->count() > 0) {
                    return response()->json([
                        'message' => 'true',
                        'data' => $data
                    ]);
                } else {
                    return response()->json([
                        'message' => 'true',
                        'data' => $data
                    ]);
                }
            } else {
                return response()->json([
                    'message' => 'false',

                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'false'
            ]);
        }
    }

    public function create()
    {
        $categories=Catagories_Store::all();
        $suppliers =Suppliers_store::all();
        $shifts=Shifts::all();

        return view('product.create', compact('categories' ,'suppliers' ,'shifts'));
    }
    public function store(Request $request)
    {


            $dataval = $request->validate([
                'تاريخ_الإنتاج' => 'nullable|date|before:today',
                'تاريخ_الانتهاء' => 'nullable|date|before:today',

                'اسم' => 'required|string|max:300',
                'وصف' => 'nullable|string|max:400',

                'الفئات' => 'required',
                'subcatg' => 'nullable',
                'subsubcatg' => 'nullable',
                'الموردين' => 'required',
                'shift' => 'required',
                'كمية' => 'required|numeric|min:1',

                'bill_image' => 'image|',
                'bill_file' => 'nullable',
            ]);



  ///products table
  $data1 = new Products();
  $data1->name = $dataval['اسم'];
  $data1->description = $dataval['وصف'];
  $data1->catg_id = $dataval['الفئات'];
  $data1->subcatg= $dataval['subcatg'];
  $data1->subsubcatg = $dataval['subsubcatg'];
  $data1->total_stock = $dataval['كمية'];
  $data1->alarm= $dataval['كمية'] / 4;
  $data1->save();

  ///////////stock table
   $last_id = Products::latest()->first()->id;

  $data2 = new Stock();
  $data2->product_id = $last_id;
  $data2->stock = $dataval['كمية'];
  $data2->production_date = $dataval['تاريخ_الإنتاج'];
  $data2->expired_date = $dataval['تاريخ_الانتهاء'];
  $data2->save();

/////////////////////////supplier_withproduct table

$data3=new Supplier_withproduct();

 $data3->product_id=$last_id;
 $data3->supplier_id=$dataval['الموردين'];
  $data3->stock=$dataval['كمية'];

  if ($request->hasFile('bill_image')) {
      $ex=ImageTrait::uploadImage($request->file('bill_image'),'web/raw/bill/image');
      $data3->image_file = $ex;
  }

  if ($request->hasFile('bill_file')) {
      $ex=ImageTrait::uploadImage($request->file('bill_image'),'web/raw/bill/file');
      $data3->pdf_file = $ex;
  }
  $data3->save();

// }elseif($dataval['shift']=='2'){
//     ///nigth_products table
//   $data1 = new NigthProduct();
//   $data1->name = $dataval['اسم'];
//   $data1->description = $dataval['وصف'];
//   $data1->nigth_catg_id = $dataval['الفئات'];
//   $data1->nigth_subcatg= $dataval['subcatg'];
//   $data1->nigth_subsubcatg = $dataval['subsubcatg'];
//   $data1->total_stock = $dataval['كمية'];
//   $data1->alarm= $dataval['كمية'] / 4;
//   $data1->save();

//   ///////////nigth_stock table
//    $last_id = NigthProduct::latest()->first()->id;

//   $data2 = new NigthStock_table();
//   $data2->product_id = $last_id;
//   $data2->stock = $dataval['كمية'];
//   $data2->production_date = $dataval['تاريخ_الإنتاج'];
//   $data2->expired_date = $dataval['تاريخ_الانتهاء'];
//   $data2->save();

// /////////////////////////nigth_supplier_withproduct table

// $data3=new Nigth_supplier_withproduct();

//  $data3->nigth_product_id=$last_id;
//  $data3->supplier_id=$dataval['الموردين'];
//   $data3->stock=$dataval['كمية'];

//   if ($request->hasFile('bill_image')) {
//       $ex=ImageTrait::uploadImage($request->file('nigth_bill_image'),'web/raw/nigth_bill/image');
//       $data3->image_file = $ex;
//   }

//   if ($request->hasFile('bill_file')) {
//       $ex=ImageTrait::uploadImage($request->file('nigth_bill_image'),'web/raw/nigth_bill/file');
//       $data3->pdf_file = $ex;
//   }
//   $data3->save();

// }else{

//  ///nigth_products table
//  $data1 = new NigthProduct();
//  $data1->name = $dataval['اسم'];
//  $data1->description = $dataval['وصف'];
//  $data1->catg_id = $dataval['الفئات'];
//  $data1->subcatg= $dataval['subcatg'];
//  $data1->subsubcatg = $dataval['subsubcatg'];
//  $data1->total_stock = $dataval['كمية'];
//  $data1->alarm= $dataval['كمية'] / 4;
//  $data1->save();

//  ///////////stock table
//   $last_id = NigthProduct::latest()->first()->id;

//  $data2 = new NigthStock_table();
//  $data2->product_id = $last_id;
//  $data2->stock = $dataval['كمية'];
//  $data2->production_date = $dataval['تاريخ_الإنتاج'];
//  $data2->expired_date = $dataval['تاريخ_الانتهاء'];
//  $data2->save();

// /////////////////////////supplier_withproduct table

// $data3=new Nigth_supplier_withproduct();

// $data3->product_id=$last_id;
// $data3->supplier_id=$dataval['الموردين'];
//  $data3->stock=$dataval['كمية'];

//  if ($request->hasFile('bill_image')) {
//      $ex=ImageTrait::uploadImage($request->file('late_bill_image'),'web/raw/late_bill/image');
//      $data3->image_file = $ex;
//  }

//  if ($request->hasFile('bill_file')) {
//      $ex=ImageTrait::uploadImage($request->file('late_bill_image'),'web/raw/late_bill/file');
//      $data3->pdf_file = $ex;
//  }
//  $data3->save();







                // dd($data1->id);

                DB::table('notifications')->insert([
                    'user_id' => auth()->user()->id,
                    'type' => 'Add',
                    'data' => 'تم اضافة نوع جديد: ' . $data1->id,
                ]);

                return redirect()->back()->with('message', 'تم انشاء مستلزم جديد بنجاح');

    }

    public function index_category()
    {
        $category = Catagories_Store::all();
        return view('product.cat', compact('category'));
    }
    public function nigth_index_category()
    {
        $category = NigthCatg::all();
        return view('nigth_product.cat', compact('category'));
    }

    public function index_subcat($id)
    {

        try {
            $catg=Catagories_Store::where('id' ,$id)->first();//اول جدول
             $subcatg = SubCategories_Store::where('category_id' ,$id)->get();//تاني جدول
            if ($subcatg) {
                return view('product.subcat', compact('subcatg' ,'catg'));
            } else {
                return redirect()->back()->with('error', "عذرا، ليس لديك هذا القسم");
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', "عذرا، يرجى المحاولة مرة أخرى");
        }
    }
    public function nigth_index_subcat($id)
    {

        try {
            $catg=NigthCatg::where('id' ,$id)->first();//اول جدول
             $subcatg = NigthSubCatg::where('category_id' ,$id)->get();//تاني جدول
            if ($subcatg) {
                return view('nigth_product.subcat', compact('subcatg' ,'catg'));
            } else {
                return redirect()->back()->with('error', "عذرا، ليس لديك هذه الفئة");
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', "عذرا، يرجى المحاولة مرة أخرى");
        }
    }
    public function index_subsubcat($id)
    {



             $subcatg = NigthSubCatg::where('id' ,$id)->first();//تاني جدول
             $sudsubcatg=NigthSunsubCatg::where('subcategory_id' ,'=',$id)->get();//تالت جدول

                return view('nigth_product.subsubcatg', compact('subcatg' ,'sudsubcatg'));

    }
    public function nigth_index_subsubcat($id)
    {



             $subcatg = SubCategories_Store::where('id' ,$id)->first();//تاني جدول
             $sudsubcatg=SubSubCategory::where('subcategory_id' ,'=',$id)->get();//تالت جدول

                return view('product.subsubcatg', compact('subcatg' ,'sudsubcatg'));

    }
    public function datatable_subcat($id)
    {
        try {
            $data = SubCategories_Store::where('category_id', '=', $id)
                ->get();
            if ($data) {
                return response()->json([
                    'message' => 'true',
                    'data' => $data
                ]);
            } else {
                return response()->json([
                    'message' => 'false',
                    'data' => null
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([

                'message' => 'آسف لا تسمح لك'
            ]);
        }
    }





    public function edit($id)
    {

        $data=DB::table('products')
        ->join('stock_table','stock_table.product_id','=','products.id')
        ->where('products.id', '=', $id)
        ->select('products.*','stock_table.*')
        ->first();
if ($data) {

return view('product.edit' ,compact('data' ));

}

    }
    public function nigth_edit($id)
    {

        $data=DB::table('nigth_products')
        ->join('nigth_stock_table','nigth_stock_table.nigth_product_id','=','nigth_products.id')
        ->where('nigth_products.id', '=', $id)
        ->select('nigth_products.*','nigth_stock_table.*')
        ->first();
if ($data) {

return view('nigth_product.edit' ,compact('data' ));

}

    }
    public function update(Request $request, $id)
    {

        $datavla = $request->validate([
            'تاريخ_الإنتاج' => 'nullable|date|before:today',
            'تاريخ_الانتهاء' => 'nullable|date',

            'اسم' => 'required|string|max:300',
            'كمية' => 'required|numeric',
            'وصف' => 'nullable|string|max:400',
        ]);

           $product = DB::table('products')
          ->join('stock_table', 'stock_table.product_id', '=', 'products.id')
           ->where('products.id', '=', $id)
            ->select('products.*', 'stock_table.*')
             ->first();

if ($product) {
$productUpdate = [
    'name' => $datavla['اسم'],
    'description' => $datavla['وصف'],

];
$stockupdate = [
    'stock'=>$datavla['كمية'],
    'expired_date' => $datavla['تاريخ_الانتهاء'],
    'production_date' => $datavla['تاريخ_الإنتاج'],
];

DB::table('products')
    ->where('id', $product->id)
    ->update($productUpdate);


    DB::table('stock_table')
        ->where('product_id', $product->id)
        ->update($stockupdate);


return redirect()->back()->with('message', 'تم تعديل المنتج بنجاح');
}


    }

    public function nigth_update(Request $request, $id)
    {

        $datavla = $request->validate([
            'تاريخ_الإنتاج' => 'nullable|date|before:today',
            'تاريخ_الانتهاء' => 'nullable|date',

            'اسم' => 'required|string|max:300',
            'كمية' => 'required|numeric',
            'وصف' => 'nullable|string|max:400',
        ]);

           $product = DB::table('nigth_products')
          ->join('nigth_stock_table', 'nigth_stock_table.nigth_product_id', '=', 'nigth_products.id')
           ->where('nigth_products.id', '=', $id)
            ->select('nigth_products.*', 'nigth_stock_table.*')
             ->first();

if ($product) {
$productUpdate = [
    'name' => $datavla['اسم'],
    'description' => $datavla['وصف'],

];
$stockupdate = [
    'stock'=>$datavla['كمية'],
    'expired_date' => $datavla['تاريخ_الانتهاء'],
    'production_date' => $datavla['تاريخ_الإنتاج'],
];

DB::table('nigth_stock_table')
    ->where('id', $product->id)
    ->update($productUpdate);


    DB::table('nigth_stock_table')
        ->where('product_id', $product->id)
        ->update($stockupdate);


return redirect()->back()->with('message', 'تم تعديل المنتج بنجاح');
}


    }





    public function status(Request $request)
    {
        $dataval = $request->validate([
            'id' => 'required|exists:medicine,id'
        ]);

        $data = Products::where('id', '=', $dataval['id'])->first();
        if ($data) {
            if ($data->status == 1) {
                $data->status = 0;
                $data->update();
                return response()->json([
                    'message' => 'تم تحديث الحالة',
                    'status' => '200'
                ]);
            } else {
                $data->status = 1;
                $data->update();
                return response()->json([
                    'message' => 'تم تحديث الحالة',
                    'status' => '200'
                ]);
            }
        } else {
            return response()->json([
                'message' => 'هذا المنتج لا يسمح لك',
                'status' => '500'
            ]);
        }
    }
public function show_product($id){

    $sumTotalStock = DB::table('products')
    ->where('products.catg_id', '=', $id)
    ->whereNull('products.subcatg')
    ->whereNull('products.subsubcatg')
    ->sum('total_stock');

    $data = DB::table('products')
    ->where('products.catg_id', '=', $id)
    ->whereNull('products.subcatg')
    ->whereNull('products.subsubcatg')
    ->get();



return view('product.catg_product' ,compact('data','sumTotalStock'));



}
public function nigth_show_product($id){
    $sumTotalStock = DB::table('nigth_products')
    ->where('nigth_products.nigth_catg_id', '=', $id)
    ->whereNull('nigth_products.nigth_subcatg')
    ->whereNull('nigth_products.nigth_subsubcatg')
    ->sum('total_stock');

$data = DB::table('nigth_products')
    ->where('nigth_products.nigth_catg_id', '=', $id)
    ->whereNull('nigth_products.nigth_subcatg')
    ->whereNull('nigth_products.nigth_subsubcatg')
    ->get();

return view('nigth_product.catg_product' ,compact('data','sumTotalStock'));



}
public function show_subproducts($id){

    $sumTotalStock=DB::table('products')
     ->where('products.subcatg', '=', $id )
    ->whereNull('products.subsubcatg')
    ->sum('total_stock');


    $data = DB::table('products')
    ->where('products.catg_id', '=', $id)
    ->whereNull('products.subsubcatg')
    ->get();

return view('product.subproduct' ,compact('data' ,'sumTotalStock'));



}
public function addQuantity($id){

    $data=Products::where('id',$id)->first();

 // $suppliers=Suppliers_store::all();
return view('product.addQuantity' ,compact('data' ));
}
public function nigth_addQuantity($id){

    $data=NigthProduct::where('id',$id)->first();

 // $suppliers=Suppliers_store::all();
return view('nigth_product.addQuantity' ,compact('data' ));
}
public function store_quantity(Request $request,Products $product){
    $dataval = $request->validate([
        'تاريخ_الإنتاج' => 'date|before:tomorrow',
        'تاريخ_الانتهاء' => 'date|after:today',
        'كمية' => 'required|numeric',
    ]);


if ($product) {
   $product->update([
        'total_stock' =>$product->total_stock += $dataval['كمية']
    ]);
    $product->update();

    $new_quantity = new Stock();
    $new_quantity->product_id = $product->id;
    $new_quantity->stock = $dataval['كمية'];
    $new_quantity->production_date = isset($dataval['تاريخ_الإنتاج']) ? $dataval['تاريخ_الإنتاج'] : null;
    $new_quantity->expired_date = isset($dataval['تاريخ_الانتهاء']) ? $dataval['تاريخ_الانتهاء'] : null;
    $new_quantity->save();

        return redirect()->back()->with('message', 'تمت إضافة الكمية بنجاح');
    }
}
public function nigth_store_quantity(Request $request,Products $product){
    $dataval = $request->validate([
        'تاريخ_الإنتاج' => 'date|before:tomorrow',
        'تاريخ_الانتهاء' => 'date|after:today',
        'كمية' => 'required|numeric',
    ]);


if ($product) {
   $product->update([
        'total_stock' =>$product->total_stock += $dataval['كمية']
    ]);
    $product->update();

    $new_quantity = new NigthStock_table();
    $new_quantity->product_id = $product->id;
    $new_quantity->stock = $dataval['كمية'];
    $new_quantity->production_date = isset($dataval['تاريخ_الإنتاج']) ? $dataval['تاريخ_الإنتاج'] : null;
    $new_quantity->expired_date = isset($dataval['تاريخ_الانتهاء']) ? $dataval['تاريخ_الانتهاء'] : null;
    $new_quantity->save();

        return redirect()->back()->with('message', 'تمت إضافة الكمية بنجاح');
    }
}
public function show_addquantity($id){

    $product=Products::where('id', $id)->first();
    $stock=Stock::where('product_id', $id)->get();

return view ('product.showquantity' ,compact('product' ,'stock'));
}
public function nigth_show_addquantity($id){

    $product=NigthProduct::where('id', $id)->first();
    $stock=NigthStock_table::where('nigth_product_id', $id)->get();

return view ('nigth_product.showquantity' ,compact('product' ,'stock'));
}
public function quantity_delete($id)
{
    try {

        $check = Stock::where('id', '=', $id)->delete();
        if ($check) {

            return redirect()->back()->with('message', "تم حذف بنجاح");
        } else {
            return redirect()->back()->with('error', "عذرا، يرجى المحاولة مرة أخرى");
        }
    } catch (\Throwable $th) {
        return redirect()->back()->with('error', "عذرا، يرجى المحاولة مرة أخرى");
    }}

    public function nigth_quantity_delete($id)
    {
        try {

            $check = NigthStock_table::where('id', '=', $id)->delete();
            if ($check) {

                return redirect()->back()->with('message', "تم حذف بنجاح");
            } else {
                return redirect()->back()->with('error', "عذرا، يرجى المحاولة مرة أخرى");
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', "عذرا، يرجى المحاولة مرة أخرى");
        }}


        public function quantity_edit(Request $request, $id)
        {


  try{


    $dataval = $request->validate([
        'كميه' => 'required|numeric',
        'تاريخ_الإنتاج' => 'date',
        'تاريخ_الانتهاء' => 'date',
    ]);

    Stock::where('id', $id)->update([
        'stock'=>$dataval['كميه'],
        'expired_date' => $dataval['تاريخ_الانتهاء'],
       'production_date' => $dataval['تاريخ_الإنتاج'],
    ]);



    return redirect()->back()->with('message', "تم التعديل  بنجاح");

  }catch(\Throwable $th) {
    return redirect()->back()->with('error', "عذرا، يرجى المحاولة مرة أخرى");
}}


         public function nigth_quantity_edit(Request $request, $id)
         {


   try{


     $dataval = $request->validate([
         'كميه' => 'required|numeric',
         'تاريخ_الإنتاج' => 'date',
         'تاريخ_الانتهاء' => 'date',
     ]);

     NigthStock_table::where('id', $id)->update([
         'stock'=>$dataval['كميه'],
         'expired_date' => $dataval['تاريخ_الانتهاء'],
        'production_date' => $dataval['تاريخ_الإنتاج'],
     ]);



     return redirect()->back()->with('message', "تم التعديل  بنجاح");

   }catch(\Throwable $th) {
     return redirect()->back()->with('error', "عذرا، يرجى المحاولة مرة أخرى");
 }}

          }








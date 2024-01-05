<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Used;
use App\Models\User;
use App\Models\Stock;
use App\Models\units;
use App\Models\Products;
use App\Traits\ImageTrait;
use App\Models\Raw_Materia;
use App\Models\Payment_Type;
use App\Models\stores_ready;
use Illuminate\Http\Request;
use App\Models\Orders_Details;
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
use App\Models\Supplier_withproduct;
use Illuminate\Support\Facades\Hash;
use App\Models\Raw_Material_Categories;
use App\Models\Raw_Material_Subcategories;
use Illuminate\Notifications\Notification;
use  Darryldecode\Cart\Facades\CartFacade as Cart;
use App\Models\Transactions_Store_Raw_Material_Requerd;
use Illuminate\Support\Facades\Validator;
class DailyController extends Controller
{







    public function index($id)
    {

        $data=DB::table('products')->where('subsubcatg', '=', $id)->get();
        $suppliers=User::all();
        if ($data) {
            return view( 'daily.index' ,compact('data','suppliers' ));

        }



    }


    public function create()
    {



        $categories=Catagories_Store::all();
        $suppliers =Suppliers_store::all();

        return view('product.create', compact('categories' ,'suppliers'));
    }
    public function store(Request $request)
    {




    }

    public function index_category()
    {
        $category = Catagories_Store::all();
        return view('daily.cat', compact('category'));
    }
    public function nigth_daily_index_category()
    {
        $category = Catagories_Store::all();
        return view('daily.cat', compact('category'));
    }

    public function index_subcat($id)
    {

        try {
            $catg=Catagories_Store::where('id' ,$id)->first();//اول جدول
             $subcatg = SubCategories_Store::where('category_id' ,$id)->get();//تاني جدول
            if ($subcatg) {
                return view('daily.subcat', compact('subcatg' ,'catg'));
            } else {
                return redirect()->back()->with('error', "عذرا، ليس لديك هذه الفئة");
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', "عذرا، يرجى المحاولة مرة أخرى");
        }
    }
    public function index_subsubcat($id)
    {



             $subcatg = SubCategories_Store::where('id' ,$id)->first();//تاني جدول
             $sudsubcatg=SubSubCategory::where('subcategory_id' ,'=',$id)->get();//تالت جدول

                return view('daily.subsubcatg', compact('subcatg' ,'sudsubcatg'));

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









    // public function status(Request $request)
    // {
    //     $dataval = $request->validate([
    //         'id' => 'required|exists:medicine,id'
    //     ]);

    //     $data = Products::where('id', '=', $dataval['id'])->first();
    //     if ($data) {
    //         if ($data->status == 1) {
    //             $data->status = 0;
    //             $data->update();
    //             return response()->json([
    //                 'message' => 'تم تحديث الحالة',
    //                 'status' => '200'
    //             ]);
    //         } else {
    //             $data->status = 1;
    //             $data->update();
    //             return response()->json([
    //                 'message' => 'تم تحديث الحالة',
    //                 'status' => '200'
    //             ]);
    //         }
    //     } else {
    //         return response()->json([
    //             'message' => 'هذا المنتج لا يسمح لك',
    //             'status' => '500'
    //         ]);
    //     }
    // }
public function show_product($id){



    $data = DB::table('products')
    ->where('products.catg_id', '=', $id)
    ->whereNull('products.subcatg')
    ->whereNull('products.subsubcatg')
    ->get();



return view('daily.catg_product' ,compact('data'));



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

return view('daily.subproduct' ,compact('data' ,'sumTotalStock'));



}
// public function addQuantity($id){

//     $data=Products::where('id',$id)->first();

//  // $suppliers=Suppliers_store::all();
// return view('product.addQuantity' ,compact('data' ));
// }

// public function store_quantity(Request $request,Products $product){
//     $dataval = $request->validate([
//         'تاريخ_الإنتاج' => 'date|before:tomorrow',

//         'تاريخ_الانتهاء' => 'date|aftar:today',

//         'كمية' => 'required|numeric',


//     ]);


// if ($product) {
//    $product->update([
//         'total_stock' =>$product->total_stock += $dataval['كمية']
//     ]);
//     $product->update();

//     $new_quantity = new Stock();
//     $new_quantity->product_id = $product->id;
//     $new_quantity->stock = $dataval['كمية'];
//     $new_quantity->production_date = isset($dataval['تاريخ_الإنتاج']) ? $dataval['تاريخ_الإنتاج'] : null;
//     $new_quantity->expired_date = isset($dataval['تاريخ_الانتهاء']) ? $dataval['تاريخ_الانتهاء'] : null;
//     $new_quantity->save();

//         return redirect()->back()->with('message', 'تمت إضافة الكمية بنجاح');
//     }
// }
// public function show_addquantity($id){

//     $product=Products::where('id', $id)->first();
//     $stock=Stock::where('product_id', $id)->get();

// return view ('product.showquantity' ,compact('product' ,'stock'));
// }
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




    public function add_daily_used(Request $request, $id)
    {
        $check = Products::find($id);

        $currentTime = now();
        $startTime = now()->hour(9)->minute(0)->second(0);
        $endTime = now()->hour(17)->minute(0)->second(0);

        $dataval = validator::make($request->all(), [
            'user_name' => 'required',
            'كميه' => [
                'required',
                'numeric',
                'max:100',
                'min:1',
                function ($attribute, $value, $fail) use ($currentTime, $startTime, $endTime) {
                    if (!$currentTime->isBetween($startTime, $endTime)) {
                        $fail("عذرا يرجي إدخال الكمية من الساعة 9 صباحًا إلى الساعة 5 مساءً");
                    }
                },
            ],
        ]);

        if ($check && !$dataval->fails()) {
            Used::create([
                'user_id' =>  $request->input('user_name'),
                'product_id' => $check->id,
                'used_product' => $request->input('كميه')
            ]);

            $userId = auth()->user()->id;

            Cart::session($userId)->add([
                'id' => $check->id,
                'name' => $check->name,
                'price' => 0,
                'quantity' => $request->input('كميه'),
                'attributes' => ['user_id' => $request->input('user_name')],
                'associatedModel' => $check
            ]);

            $order_id = session('order_id');

            return redirect()->back()->with('message', "تم السحب بنجاح");

        } else {
        return redirect()->back()->with('error', "عذراً، هذا المنتج غير متوفر أو هناك مشكلة في البيانات المدخلة");
        }
    }

public function daily_view()
{



//     $sumSubquery = Used::select('product_id', DB::raw('SUM(used_product) as total_used'))
//     ->whereDate('created_at', Carbon::today())
//     ->groupBy('product_id');
// $usedDetails = Used::with(['product', 'user'])
//     ->joinSub($sumSubquery, 'sums', function ($join) {
//         $join->on('used.product_id', '=', 'sums.product_id');
//     })
//     ->select('used.*', 'sums.total_used')
//     ->whereDate('used.created_at', Carbon::today())
//     ->get();


$sumSubquery = Used::select('user_id', 'product_id', DB::raw('SUM(used_product) as total_used'))
    ->whereDate('created_at', Carbon::today())
    ->groupBy('user_id', 'product_id');

$usedDetails = Used::with(['product', 'user'])
    ->joinSub($sumSubquery, 'sums', function ($join) {
        $join->on('used.product_id', '=', 'sums.product_id');
        $join->on('used.user_id', '=', 'sums.user_id');
    })
    ->select('used.*', 'sums.total_used')
    ->whereDate('used.created_at', Carbon::today())
    ->get();
    $items = $usedDetails;

return view('daily.daily_view', ['items' => $usedDetails]);


}

public function shifts()
{

    return view('daily.shifts');
}
public function daily_used_delete($id)
{

    try {
        $check = Used::where('id', '=', $id)->first();
        if ($check) {
            $check->delete() ;
            return redirect()->back()->with('message', "تم حذف بنجاح");
        } else {
            return redirect()->back()->with('error', "عذرا، يرجى المحاولة مرة أخرى");
        }
    } catch (\Throwable $th) {
        return redirect()->back()->with('error', "عذرا، يرجى المحاولة مرة أخرى");
    }
}

public function daily_used_edit(Request $request, $id)
{
    $userId = auth()->user()->id;
    $check = Products::where('id', '=', $id)->first();


    $dataval = $request->validate([
        'كميه' => 'required|numeric|min:1',
    ]);

    if ($check) {


        if ($dataval['كميه']) {

            Cart::session($userId)->update($id, array(

                'quantity' => array(
                    'relative' => false,
                    'value' => $dataval['كميه'],
                ),
            ));

            return redirect()->back()->with('message', "تم تعديل الكمية بنجاح");
        } else {
            return redirect()->back()->with('error', "عذرًا، الكمية المطلوبة غير متوفرة في المخزن");
        }
    } else {
        return redirect()->back()->with('error', "عذرًا، يرجى المحاولة مرة أخرى");
    }
}


    }

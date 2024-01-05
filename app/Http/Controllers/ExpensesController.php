<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Orders;
use Illuminate\Http\Request;
use App\Models\Catagories_Store;
use App\Models\Orders_Details;
use App\Models\Products;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;
use App\Models\SubCategories_Store;
use App\Models\SubSubCategory;
use  Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Facades\Auth;

class ExpensesController extends Controller
{

    public function __construct()
    {
        $this->middleware(['staff']);

    }
    public function create_invoce()
    {

        $users = DB::table('users')
            ->join('job_title', 'users.job_type', '=', 'job_title.id')
            ->where('users.id', '!=', auth()->user()->id)

            ->select([
                'users.id as users_id',
                'users.name as users_name',
                'job_title.id as job_title_id',
                'job_title.title as job_title_name',
            ])
            ->get();
        $uniqueCategories = $users->unique('job_title_id');

        return view('Expenses.index', ['data' => $users, 'uniqueCategories' => $uniqueCategories]);
    }


    public function store_invoce(Request $request)
    {


        $dataval = $request->validate([
            'طالب_الصرف' => 'required|numeric|exists:users,id',
            'صورة_الصرف' => 'image|mimes:jpeg,png,jpg|max:6502|required_without_all:pdf_الصرف',
            'pdf_الصرف' => 'nullable|mimes:doc,docx,pdf|max:6048|required_without_all:صورة_الصرف',

        ]);
        try {

            $data = new Orders();
            $data->casher_id = auth()->user()->id;
            $data->employee_id = $dataval['طالب_الصرف'];

            if ($request->hasFile('صورة_الصرف')) {
                $file = $request->file('صورة_الصرف');
                $n = $file->getClientOriginalName();
                $ex = time() . '.' . $n;
                $file->move('web/expenses/bill/image/', $ex);
                $data->image = $ex;
            }
            if ($request->hasFile('pdf_الصرف')) {
                $file = $request->file('pdf_الصرف');
                $n = $file->getClientOriginalName();
                $ex = time() . '.' . $n;
                $file->move('web/expenses/bill/file/', $ex);
                $data->pdf = $ex;
            }
            $data->save();

            session(['order_id'=> $data->id]);

            $user_id = auth()->user()->id;
            Cart::session($user_id)->clear();


            return redirect()->route('expenses.categories')->with('message', 'تم انشاء اذن الصرف الان ضيف المنتجات المطلوبه');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'آسف يرجى المحاولة مرة أخرى');
        }
    }




    public function index_category()
    {

        $order_id = session('order_id');
        if ($order_id !=null) {
            $data = Catagories_Store::all();
            return view('Expenses.cat', ['data' => $data]);
        } else {
            return redirect()->route('expenses.create_invoce')->with('error', ' يجب ادخال اذن الصرف');
        }
    }


    public function index_subcat($id)
    {

    try {
        $catg=Catagories_Store::where('id' ,$id)->first();//اول جدول
         $subcatg = SubCategories_Store::where('category_id' ,$id)->get();//تاني جدول
        if ($subcatg) {
            return view('Expenses.subcat', compact('subcatg' ,'catg'));
        } else {
            return redirect()->back()->with('error', "عذرا، ليس لديك هذه الفئة");
        }
    } catch (\Throwable $th) {
        return redirect()->back()->with('error', "عذرا، يرجى المحاولة مرة أخرى");
    }


     }

     public function expenses_subsub($id)
     {

              $subcatg = SubCategories_Store::where('id' ,$id)->first();//تاني جدول
              $sudsubcatg=SubSubCategory::where('subcategory_id' ,'=',$id)->get();//تالت جدول

                 return view('Expenses.subsubcatg', compact('subcatg' ,'sudsubcatg'));

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

    public function index($id)
    {


        try {
            $check = SubCategories_Store::where('id', '=', $id)
                ->first();
            if ($check) {



                return view('Expenses.product', ['data' => $check]);
            } else {
                return redirect()->back()->with('error', 'لا يوجد هذا الفئه الفرعيه');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'آسف يرجى المحاولة مرة أخرى');
        }
    }
    public function datatable($id)
    {
        try {
            $check = SubCategories_Store::where('id', '=', $id)
                ->first();
            if ($check) {


                $data = DB::table('medicine')
                    ->join('subcategories_store', 'medicine.category_id', '=', 'subcategories_store.id')
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
    public $items;

    public function add_to_card(Request $request, $id)
    {

        $check = Products::where('id', '=', $id)->first();
        $check22=Stock::where('product_id',$id)->first();

        $userId = auth()->user()->id;

        $dataval = $request->validate([
            'كميه' => 'required|numeric|min:1'
        ]);

        if ($check) {
            if ($dataval['كميه'] <= $check22->stock) {
                Cart::session($userId)->add(array(
                    'id' => $check22->product_id,
                    'name' => $check->name,
                    'price' => 0,
                    'quantity' => $dataval['كميه'],
                    'attributes' => array(),
                    'associatedModel' => $check
                ));

                $order_id = session('order_id');
                // $order_details=Orders_Details::create([
                //     'order_id'=>$order_id,
                //     'product_id'=>$check->id,
                //     'amount'=>$dataval['كميه'],
                // ]);

                return redirect()->back()->with('message', "تم اضاقه بنجاح");
            } else {
                return redirect()->back()->with('error',   "غذرا لا يوحد هذه الكميه فى المخزن");
            }
        } else {
            return redirect()->back()->with('error', "عذرا، يرجى المحاولة مرة أخرى");
        }
    }
    public function card_view()
    {
        $userId = auth()->user()->id;
        $items = Cart::session($userId)->getContent();
        return view('Expenses.card_view', ['data' => $items]);
    }
    public function card_delete($id)
    {

        try {
            $userId = auth()->user()->id;
            $check = Products::where('id', '=', $id)->first();
            if ($check) {
                Cart::session($userId)->remove($id);
                return redirect()->back()->with('message', "تم حذف بنجاح");
            } else {
                return redirect()->back()->with('error', "عذرا، يرجى المحاولة مرة أخرى");
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', "عذرا، يرجى المحاولة مرة أخرى");
        }
    }



    public function card_edit(Request $request, $id)
    {
        $userId = auth()->user()->id;
        $check = Products::where('id', '=', $id)->first();
        $check22=Stock::where('product_id',$id)->first();

        $dataval = $request->validate([
            'كميه' => 'required|numeric|min:1',
        ]);

        if ($check) {


            if ($dataval['كميه'] <= $check22->stock) {

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




    public function card_save()
    {
        try {

            $order_id = session('order_id');
            $userId = auth()->user()->id;

            $du = Cart::session($userId)->getContent();

            if ($du->count() > 0 && $order_id != null) {
                foreach ($du as $data) {
                    $change = Products::find($data->id);
                    $check22=Stock::where('product_id',$data->id)->first();

                    if ($check22 && $check22->stock >= $data->quantity) {
                        // Start a database transaction

                        try {
                            $create = Orders_Details::create([
                                'order_id' => $order_id,
                                'medicine_id' =>$data->id,
                                'amount' => $data->quantity,
                            ]);

                            $check22->stock -= $data->quantity;
                            $check22->update();

                            // Commit the transaction
                            DB::commit();
                        } catch (\Throwable $th) {
                            // An error occurred, rollback the transaction
                            DB::rollBack();
                            throw $th; // Rethrow the exception for further handling
                        }
                    }
                }

                Cart::session($userId)->clear();
                session()->forget('order_id');

                return redirect()->back()->with('message', "تم صرف المنتجات بنجاح");
            } else {
                return redirect()->route('expenses.create_invoce')->with('error', ' العربيه فارغه يجب ادخال اذن الصرف');
            }
        } catch (\Throwable $th) {
            // Log or display the actual error message for debugging
            return redirect()->back()->with('error', "عذرًا، يرجى المحاولة مرة أخرى");
        }
    }



    public function histore()
    {


        try {


        return view('histore.index');

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'آسف يرجى المحاولة مرة أخرى');
        }
    }
    public function histore_datatable()
    {
        try {




                    $data=DB::table('orders')
                    ->join('users as cache','orders.casher_id','=','cache.id')
                    ->join('users as employee','orders.employee_id','=','employee.id')
                    ->select([
                        'cache.name as cache_name',
                        'employee.name as employee_name',
                        'orders.id',
                        'orders.created_at',
                        'orders.image',
                        'orders.pdf'


                    ])->get();

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
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'false'
            ]);
        }
    }


    public function histore_one($id)
    {

        try {
            $items = Orders_Details::where('order_id',$id)->first();
            return view('histore.one',compact('items'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Sorry, please try again.');
        }
    }
    public function histore_datatable_one($id)
    {
        try {

            $data = DB::table('stock')->where('order_id' ,$id)->get();

            return response()->json(['data' => $data]);

        } catch (\Throwable $th) {
            return response()->json(['message' => 'false']);
        }
    }

    public function subsubproducts($id){


        $data=DB::table('products')
                    ->join('stock_table','stock_table.product_id','=','products.id')
                    ->where('products.subsubcatg', '=', $id)
                    ->select('products.*','stock_table.*')
                    ->get();

        if ($data) {
            return view('Expenses.subsubproducts' ,compact('data'));

        }



    }
    public function expenses_pull(Request $request,$id){



        $dataval = $request->validate([
            'كميه' => 'required|numeric|min:1'
        ]);

        $data=DB::table('products')
        ->join('stock_table','stock_table.product_id','=','products.id')
        ->where('products.id', '=', $id)
        ->select('products.*','stock_table.*')
        ->first();



        if ($data) {
            if ($dataval['كميه'] <= $data->stock) {
                $updated_stock = $data->stock - $dataval['كميه'];

                // Update the stock in the database
                DB::table('stock_table')
                    ->where('product_id', $data->id)
                    ->update(['stock' => $updated_stock]);

                return redirect()->back()->with('message', 'تم سحب الكمية بنجاح');
            } else {
                return redirect()->back()->with('error', 'عذرًا، لا يوجد هذه الكمية في المخزن');
            }
        } else {
            return redirect()->back()->with('error', 'عذرًا، يرجى المحاولة مرة أخرى');
        }

}
public function expenses_catgpull(Request $request,$id){



    $dataval = $request->validate([
        'كميه' => 'required|numeric|min:1'
    ]);



    $data=DB::table('products')
    ->join('stock_table','stock_table.product_id','=','products.id')
    ->where('products.id', '=', $id)
    ->select('products.*','stock_table.*')
    ->first();


    if ($data) {
        if ($dataval['كميه'] <= $data->stock) {
            $updated_stock = $data->stock - $dataval['كميه'];

            // Update the stock in the database
            DB::table('stock_table')
                ->where('product_id', $data->id)
                ->update(['stock' => $updated_stock]);

            return redirect()->back()->with('message', 'تم سحب الكمية بنجاح');
        } else {
            return redirect()->back()->with('error', 'عذرًا، لا يوجد هذه الكمية في المخزن');
        }
    } else {
        return redirect()->back()->with('error', 'عذرًا، يرجى المحاولة مرة أخرى');
    }


}
public function show_product($id){
try{

    $data=DB::table('products')
    ->join('stock_table','stock_table.product_id','=','products.id')
    ->where('products.catg_id', '=', $id )
    ->whereNull('products.subcatg')
    ->whereNull('products.subsubcatg')
    ->select('products.*','stock_table.*')
    ->get();
    if($data){
        return view('Expenses.catg_product' ,compact('data'));
    }else{
        return redirect()->back()->with('error', '  آسف   لا توجد منتجات في هذة الفئة اذهب لقائمة المنتجات وقوم بادخال منتج جديد' );
    }


} catch (\Throwable $th) {
    return redirect()->back()->with('error', 'آسف   يرجي المحاولة لاحقا');
}
}
public function show_subproduct($id){

    $data=DB::table('products')
    ->join('stock_table','stock_table.product_id','=','products.id')
    ->where('products.subcatg', '=', $id )

    ->whereNull('products.subsubcatg')
    ->select('products.*','stock_table.*')
    ->get();

return view('Expenses.subproduct' ,compact('data'));



}
public function expenses_subcatgpull(Request $request,$id){



    $dataval = $request->validate([
        'كميه' => 'required|numeric|min:1'
    ]);



    $data=DB::table('products')
    ->join('stock_table','stock_table.product_id','=','products.id')
    ->where('products.id', '=', $id)
    ->select('products.*','stock_table.*')
    ->first();


    if ($data) {
        if ($dataval['كميه'] <= $data->stock) {
            $updated_stock = $data->stock - $dataval['كميه'];

            // Update the stock in the database
            DB::table('stock_table')
                ->where('product_id', $data->id)
                ->update(['stock' => $updated_stock]);

            return redirect()->back()->with('message', 'تم سحب الكمية بنجاح');
        } else {
            return redirect()->back()->with('error', 'عذرًا، لا يوجد هذه الكمية في المخزن');
        }
    } else {
        return redirect()->back()->with('error', 'عذرًا، يرجى المحاولة مرة أخرى');
    }


}

}

<?php

namespace App\Http\Controllers;

use App\Models\Suppliers_Address_store;
use App\Models\Suppliers_Phones_store;
use Illuminate\Http\Request;
use App\Models\Suppliers_store;
use Illuminate\Support\Facades\DB;

class Suppliers_StoreController extends Controller
{

    public function __construct()
    {
        $this->middleware(['staff']);

    }

    public function index()
    {


       $suppliers=Suppliers_store::all();
 $supplier_phone=Suppliers_Phones_store::all();
 $supplier_location=Suppliers_Address_store::all();

 return view('supplier.index' ,compact('suppliers' ,'supplier_phone' ,'supplier_location'));

    }
    public function datatable()
    {
        $data = Suppliers_store::select('*')->get();
        if ($data) {
            return response()->json([
                'message' => 'true',
                'data' => $data
            ]);
        } else {
            return response()->json([
                'message' => 'true',

            ]);
        }
    }



    public function view_phone_address($id)
    {
        /*
        $data=Suppliers_store::where('company_id','=',auth()->user()->company_id)->where('id','=',$id)
        ->with(['phones','address'])
        ->get();
     */
        $data = DB::table('suppliers')
            ->leftJoin('suppliers_phones', 'suppliers.id', '=', 'suppliers_phones.supplier_id')
            ->where('suppliers.id', '=', $id)

            ->select([
                'suppliers_phones.name as phone_name',
                'suppliers_phones.phone',

            ])
            ->distinct()
            ->get();





        if ($data) {
            return response()->json($data);
        } else {
            return response()->json(null);
        }
    }
    public function view_address($id)
    {

        $data = DB::table('suppliers')
            ->Join('supplier_location', 'suppliers.id', '=', 'supplier_location.supplier_id')
            ->where('suppliers.id', '=', $id)

            ->select([

                'supplier_location.name as address',
                'supplier_location.location as location'
            ])
            ->distinct()
            ->get();





        if ($data) {
            return response()->json($data);
        } else {
            return response()->json(null);
        }
    }

    public function create()
    {

        return view('supplier.create');
    }
    public function create_phone($id)
    {

        try {


            $check = Suppliers_store::where('id', '=', $id)->first();
            if ($check) {

                return view('supplier.create_phone', ['id' => $id]);
            } else {
                return redirect()->route('admin.companies.suppliers.create')->with('error', 'آسف لا تسمح ');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'حاول مرة اخرى');
        }
    }
    public function create_address($id)
    {

        try {


            $check = Suppliers_store::where('id', '=', $id)->first();
            if ($check) {

                return view('supplier.address', ['id' => $id]);
            } else {
                return redirect()->route('admin.companies.suppliers.create')->with('error', 'آسف لا تسمح ');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'حاول مرة اخرى');
        }
    }
    public function store(Request $request)
    {

        $dataval = $request->validate([
            'name' => 'required|string|max:400',
            'logo' => 'image|mimes:jpeg,png,jpg|max:6502|required',
            'location' => 'string|max:1000|required',
            'phone' => 'min:10|max:15|required',
            'email'=>'required|email',
            'company_file'=>'required',
        ]);
        try {


            $data1 = new Suppliers_store();

            $data1->name = $dataval['name'];
            $data1->email = $dataval['email'];
            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $n = $file->getClientOriginalName();
                $ex = time() . '.' . $n;
                $file->move('web/suppliers/image/', $ex);
                $data1->logo = $ex;
            }
            if ($request->hasFile('company_file')) {
                $file = $request->file('company_file');
                $n = $file->getClientOriginalName();
                $ex = time() . '.' . $n;
                $file->move('web/suppliers/company_file/', $ex);
                $data1->company_file = $ex;
            }
            $data1->save();

            $last_id = Suppliers_store::latest()->first()->id;
            $data2 = new Suppliers_Address_store();
            $data2->supplier_id = $last_id;
            $data2->location = $dataval['location'];
            $data2->save();

            $data3 = new Suppliers_Phones_store();
            $data3->supplier_id = $last_id;
            $data3->phone = $dataval['phone'];
            $data3->save();


            $id_suppliers = $data1->id;
            return redirect()->back()->with('message', 'تمت إضافة المورد الجديد بنجاح');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'حاول مرة اخرى');
        }
    }

    public function store_phone(Request $request, $id)
    {


        $dataval = $request->validate([
            'phone' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:15|required',
            'name' => 'nullable|string|max:300'

        ]);
        try {


            $data = new Suppliers_Phones_store();
            $data->name = $dataval['name'];
            $data->phone = $dataval['phone'];
            $data->supplier_id = $id;
            $data->save();
            return redirect()->back()->with('message', 'تمت إضافة الهاتف بنجاح');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'حاول مرة اخرى');
        }
    }
    public function store_address(Request $request, $id)
    {

        $dataval = $request->validate([
            'location' => 'string|max:1000|regex:/^(https?:\/\/)?(www\.)?google\.com\/maps\/.*$/|nullable',
            'name' => 'required|string|max:300'
        ]);
        try {


            $data = new Suppliers_Address_store();
            $data->name = $dataval['name'];
            $data->location = $dataval['location'];
            $data->supplier_id = $id;
            $data->save();
            return redirect()->back()->with('message', 'تم اضافة العنوان بنجاح');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'حاول مرة اخرى');
        }
    }

    public function edit($id)
    {
        try {

            $data1 = Suppliers_store::where('id', '=', $id)->first();
          $data2=Suppliers_Address_store::where('supplier_id', '=', $id)->first();
          $data3=Suppliers_Phones_store::where('supplier_id', '=', $id)->first();
                return view('supplier.edit', compact('data1' ,'data2' ,'data3'));


        } catch(\Throwable $th) {
            return redirect()->back()->with('error', 'حاول مرة اخرى');
        }
    }
    public function update(Request $request, $id)
{
    $dataval = $request->validate([
        'name' => 'required|string|max:400',
        'logo' => 'image|mimes:jpeg,png,jpg|max:6502|nullable',
        'location' => 'string|max:1000|nullable',
        'phone' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:15|nullable',
        'email' => 'email|nullable',
        'company_file' => 'nullable',
    ]);

    $supplier =Suppliers_store::where('id' ,$id)->update([

        'name' => $dataval['name'],
        'email' => $dataval['email'],

    ]);
    if ($request->hasFile('logo')) {
        $logoFile = $request->file('logo');
        $logoName = time() . '_' . $logoFile->getClientOriginalName();
        $logoFile->move('web/suppliers/image/', $logoName);
        Suppliers_store::where('id' ,$id)->update([


           'logo'=>$logoFile,

        ]);
    }


    if ($request->hasFile('company_file')) {
        $file = $request->file('company_file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move('web/suppliers/company_file/', $fileName);
        Suppliers_store::where('id' ,$id)->update([

            'logo'=>$fileName,

         ]);
    }






            if ($request->has('location')) {
                $locationUpdate = [
                    'location' => $dataval['location'],
                ];
                DB::table('supplier_location')
                    ->where('supplier_id', $id)
                    ->update($locationUpdate);
            }

            if ($request->has('phone')) {
                $phoneUpdate = [
                    'phone' => $dataval['phone'],
                ];
                DB::table('suppliers_phones')
                    ->where('supplier_id', $id)
                    ->update($phoneUpdate);
            }

            return redirect()->route('admin.companies.suppliers.store.index')->with('message', 'تم تعديل  بيانات المورد بنجاح');


}
public function view_image($id)
{
    $fileInfo = Suppliers_store::findOrFail($id);


    $filePath = public_path('web/suppliers/image/' . $fileInfo->logo);

    return response()->file($filePath);

}
public function view_file($id)
{
    $fileInfo = Suppliers_store::findOrFail($id);


    $filePath = public_path('web/suppliers/company_file/' . $fileInfo->company_file);

    return response()->file($filePath);

}

        }



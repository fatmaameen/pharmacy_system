<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Models\Types_of_jobs;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;


use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdmimCompanyController extends Controller
{


    public function __construct()
    {
        $this->middleware('admin');

    }

    public function index(){


        return view('users.index');

    }
    public function datatable(){

        $users = User::select('*')->with(['role_name','job'])->get();
        if($users){
            return response()->json([
                'data'=>$users,
                'message'=>true
            ]);
        }else{
            return response()->json([

                'message'=>false
            ]);
        }


    }
    public function status(Request $request)
    {
        $dataval = $request->validate([
            'id' => 'required|exists:users,id'
        ]);
        $data = User::find($dataval['id']);
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
                'message' => 'errors',
                'status' => '500'
            ]);
        }
    }
    public function create(){
      $roles=DB::table('roles')->get();
      $job_title=Types_of_jobs::all();
  //  $roles = Role::pluck('name', 'name')->all();

        return view('users.create',['roles'=>$roles,'job_title'=>$job_title]);

    }
    public function store(Request $request){

        $datavla=$request->validate([
            'status'=>'required|boolean',
            'role_id'=>'required|numeric|exists:roles,id',
            'job_type'=>'required|numeric|exists:job_title,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:8|confirmed',
             'avatar'=> 'image|mimes:jpeg,png,jpg|max:6502|nullable',




        ]);
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
/*
        $data=new User();
        $data->name=$datavla['name'];
        $data->email=$datavla['email'];
        $data->company_id=$datavla['company_id'];
        $data->password=Hash::make($datavla['password']);
        */
     //   $data->roles_name=$request->input('roles');

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $n = $file->getClientOriginalName();
            $ex = time() . '.' . $n;
            $file->move('web/user/image/', $ex);
            $input['avatar']=$ex;
        }


        $user = User::create($input);

        return redirect()->back()->with('message','تم إضافة موظف جديد بنجاح');

    }
    public function edit($id){
        $roles=DB::table('roles')->get();
        $job_title=Types_of_jobs::all();
        $data = User::find($id);
        return view('users.edit',compact('data','roles','job_title'));



    }
    public function update(Request $request,$id){
        $user = User::find($id);
        $datavla=$request->validate([
            'status'=>'required|boolean',
            'role_id'=>'required|numeric|exists:roles,id',
            'job_type'=>'required|numeric|exists:job_title,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
             'avatar'=> 'image|mimes:jpeg,png,jpg|max:6502|nullable',




        ]);
        $input = $request->all();




        if($request->password !=null){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input['password']=$user->password;
        }

        if ($request->hasFile('avatar')) {
            try {
                unlink(asset('web/user/image/'.$user->logo));
            } catch (\Throwable $th) {

            }

            $file = $request->file('avatar');
            $n = $file->getClientOriginalName();
            $ex = time() . '.' . $n;
            $file->move('web/user/image/', $ex);
            $input['avatar']=$ex;
        }
        $user->update($input);

        return redirect()->back()->with('message','تم تحديث طاقم العمل بنجاح');

    }
}

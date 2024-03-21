<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{


    public function login_page(){
        return view('login');

    }
    public function save_reg(Request $request){
       // dd($request->all());
        try{
            DB::beginTransaction();
            $addUser = new Admin;
            $addUser->name            = $request->name;
            $addUser->email           = $request->email;
            $addUser->password        = md5($request->password);;
            $addUser->save();
            DB::commit();

            session()->put('admin-session-data',$request->name);

            return redirect('home')->with(['success' =>'registration successfully.']);

        }catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'with' => 'error',
                'message' => 'Error creating . ' . $e->getMessage(),
            ]);
        } 

    }

    public function save_login(Request $request){
      //  dd($request->all());
        try{
            DB::beginTransaction();
            $pass = md5($request->password);
            $user_count = Admin::where(['name'=>$request->name , 'password' =>$pass])->count();
            //dd($user_count);
            if($user_count > 0){
                session()->put('admin-session-data',$request->name);
                return redirect('home')->with(['success' =>'Login successfully.']);
            }else{
                return redirect('/');
            }
        }catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'with' => 'error',
                'message' => 'Error creating . ' . $e->getMessage(),
            ]);
        } 
    }
}

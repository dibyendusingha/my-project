<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\Form;
use Illuminate\Support\Facades\Auth;

class admincontroller extends Controller
{
    public function index_page(){
        
        $user_details = Form::get();
        return view('admin.index',['user_details'=>$user_details]);
        //return view('admin.index');
    }

    public function form_page(){
        return view('admin.form');
    }

    public function edit_page($user_id){
        $edit_user = Form::where('id',$user_id)->first();
        return view('admin.edit',['edit_user'=>$edit_user]);
    }

    public function add_user(Request $request){
        //dd($request->all());

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required|size:10',
            'gender' => 'required',
            'address' => 'required',
            'qualification' => 'required',
            'hobbies'=> 'required',
            //'image'=> 'required',
            'status'=> 'required'
        ]);

        $profile_img = $request->image; 
        if ($profile_img) {
            $rand = rand(10000,99999);
            $imageName = time(). '_img_'.$rand.'.' . $profile_img->extension();
            $profile_img->move(public_path('images/user'), $imageName);
            $relativePath = 'images/user/' . $imageName;
        }else{
            $relativePath = null; 
        }

        if ($validator->fails()) {
            $output['response']=false;
            $output['message']='Validation error!';
            $output['error'] = $validator->errors();
            return $output;
            exit;
        }else{

            try{
                DB::beginTransaction();
                $addUser = new Form;
                $addUser->name            = $request->name;
                $addUser->email           = $request->email;
                $addUser->mobile          = $request->mobile;
                $addUser->gender          = $request->gender;
                $addUser->address         = $request->address;
                $addUser->qualification   = $request->qualification;
                $addUser->hobbies         = json_encode($request->hobbies);
                $addUser->status          = $request->status;
                $addUser->image           = $relativePath;

                $addUser->save();
                DB::commit();
    
                return redirect('home')->with(['success' =>'created successfully.']);
    
            }catch (\Exception $e) {
                return response()->json([
                    'status' => false,
                    'with' => 'error',
                    'message' => 'Error creating . ' . $e->getMessage(),
                ]);
            } 

        }
    }

    public function delete_user_list($user_id){
       // dd($user_id);
        $user_details = Form::where('id',$user_id)->delete();
        return redirect('home')->with(['success' =>'Deleted Successfully']);
    }

    public function edit_user($user_id){
        $edit_user = Form::where('id',$user_id)->first();
        return view('admin.edit',['edit_user'=>$edit_user]);
    }

    public function update_user(Request $request,$user_id){
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required|size:10',
            'gender' => 'required',
            'address' => 'required',
            'qualification' => 'required',
            'hobbies'=> 'required',
            //'image'=> 'required',
            'status'=> 'required'
        ]);

        $img_det = Form::where('id',$user_id)->first();
        $old_img = $img_det->image;
       // dd($old_img);
        $profile_img = $request->edit_image;
        if (!empty($request->edit_image)) {
            $oldImagePath = $img_det->image;
            if ($oldImagePath && file_exists(public_path($oldImagePath))) {
                unlink(public_path($oldImagePath));
            }
         
            $rand = rand(10000,99999);
            $imageName = time(). '_img_'.$rand.'.' . $profile_img->extension();
            $profile_img->move(public_path('images/user'), $imageName);
            $relativePath = 'images/user/' . $imageName;
        }
        else if(empty($request->image)){
            $relativePath = $old_img; 
        }

        if ($validator->fails()) {
            $output['response']=false;
            $output['message']='Validation error!';
            $output['error'] = $validator->errors();
            return $output;
            exit;
        }else{

            try{
                DB::beginTransaction();
                $editUser = Form::where('id',$user_id)->first();
                $editUser->name            = $request->name;
                $editUser->email           = $request->email;
                $editUser->mobile          = $request->mobile;
                $editUser->gender          = $request->gender;
                $editUser->address         = $request->address;
                $editUser->qualification   = $request->qualification;
                $editUser->hobbies         = json_encode($request->hobbies);
                $editUser->status          = $request->status;
                $editUser->image           = $relativePath;

                $editUser->update();
                DB::commit();
    
                return redirect('home')->with(['success' =>'update successfully.']);
    
            }catch (\Exception $e) {
                return response()->json([
                    'status' => false,
                    'with' => 'error',
                    'message' => 'Error creating . ' . $e->getMessage(),
                ]);
            } 
        }
    }
}






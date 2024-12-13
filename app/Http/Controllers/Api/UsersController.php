<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Str,Validator;
class UsersController extends Controller
{
    //


    public function getUserList()
    {
        try {
            $getUserData = User::with('getUserRoles')->orderBy('id', 'desc')->get();
            if(!empty($getUserData)){
                return response()->json([ 'status'=>'success','message' => 'Users list get successfully', 'data' => $getUserData], 200);
            }else{
                return response()->json(['status'=>'error', 'message' => 'No user found','data' => []], 404);
            }
           
        } catch (Exception $e) {
            return response()->json(['status'=>'error', 'message' => $e->getMessage(),'data' => []], 500);
        }
    }
 

    public function storeUserData(Request $request)
    {
        try {
          
        
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'phone' => 'required|regex:/^[6-9][0-9]{9}$/|unique:users,phone',
                'role_id' => 'required|exists:user_roles,id',
                'description' => 'nullable|string',
                'profile_image' => 'required|image|mimes:jpeg,jpg,png,svg,gif',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()->first()], 422);
            }            
            if($request->hasFile('profile_image')){
                $image = $request->file('profile_image');
                $imageName = $image->getClientOriginalName();
                $filename = Str::random(25).'.'.$image->getClientOriginalExtension();
                $image->move(public_path('uploads/profile_image'),$filename);
                $imagePath = 'uploads/profile_image/'. $filename;
            }

            $user = new User();
            $user->role_id = $request->role_id;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->description = $request->description;
            $user->profile_image = $imagePath;
            $user->save();

            return response()->json(['success' => true, 'message' => 'User added successfully.', 'data' => $user], 200);
        } catch (Exception $e) {
            return response()->json(['errors' => true, 'message' => $e->getMessage()], 500);
        }
    }
}

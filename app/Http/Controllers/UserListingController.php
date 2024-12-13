<?php

namespace App\Http\Controllers;
use App\Models\{User,UserRoles};
use Illuminate\Http\Request;

class UserListingController extends Controller
{
    //
    public function storeUserData()
    {
        try {
            $get_user_roles = UserRoles::orderBy('id', 'desc')->get();
            return view('Users.users-listing', compact('get_user_roles'));
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
 
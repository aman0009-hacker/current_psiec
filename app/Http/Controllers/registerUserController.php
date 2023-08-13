<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class registerUserController extends Controller
{
    public function index(Request $request)
    {
      $user=new User;

      $user->name=$request->name;
      $user->last_name=$request->last_name;
      $user->email=$request->email;
      $user->contact_number=$request->contact_number;
      $user->password=Crypt::encrypt($request->password);

    }
}

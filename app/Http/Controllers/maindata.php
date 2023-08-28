<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class maindata extends Controller
{
    public function main()
    {
      $main= DB::table('users')->paginate(5);
      return view('selectCheckbox',compact('main'));
    }
}

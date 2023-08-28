<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class testingLogic extends Controller
{
    public function logic()
    {
        $main=  \DB::table('users')
        ->leftJoin('payment_data_handling', 'users.id', '=', 'payment_data_handling.user_id')
        ->whereNull('payment_data_handling.user_id')
        ->where('users.approved','1') 
        ->select('users.*')
        ->get();
        dd($main);
    }
}

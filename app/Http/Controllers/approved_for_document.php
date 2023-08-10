<?php

namespace App\Http\Controllers;

use App\Models\PaymentDataHandling;
use Illuminate\Http\Request;
use App\Models\User;

class approved_for_document extends Controller
{
    public function data()
    {
       
      $main=  \DB::table('users')->where('approved','1')
    ->leftJoin('payment_data_handling', 'users.id', '=', 'payment_data_handling.user_id')
    ->whereNull('payment_data_handling.user_id') 
    ->select('users.*')
    ->get();
    
    foreach($main as $singleMain)
    {
        $details = [
            'email' => 'PSIEC ADMIN PANEL',
            'body' => 'Congratulations!!! Your documents are verified,please do the payment',
        ];
        \Mail::to($singleMain->email)->send(new \App\Mail\PSIECMail($details));  


    }
   
   
       
    }
}

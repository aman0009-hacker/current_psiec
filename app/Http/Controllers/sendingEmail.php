<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\PaymentDataHandling;
use App\Models\User;


class sendingEmail extends Controller
{
    public function king()
    {
       
        $king = PaymentDataHandling::where('data','registration_amount')->where('payment_status','SUCCESS')->get();
    
       
    
        foreach($king as $queen)
        {
             
            $startDate = Carbon::parse($queen->updated_at);
            
            $endDate = Carbon::now(); 
            
            $diffInDays = $startDate->diffInDays($endDate);
            
            $daysLeft = 365 - $diffInDays;
            
         
            
            if($daysLeft <= 10)
            {
               if($daysLeft === 0)
               {
                continue;
               }
               else
               {
               
                $user = User::find($queen->user_id);
                $mail=$user->email;
             
               $details = [
                'email' => 'PSIEC ADMIN PANEL',
                'body' => 'Your subscription is about to expire in 10 days. Please renew your subscription to continue enjoying our services.',
              
            ];
            \Mail::to($mail)->send(new \App\Mail\PSIECMail($details));
               }
             
            }
        }
  

    }
}

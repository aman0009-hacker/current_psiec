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
        $users=[];
        $king = PaymentDataHandling::where('data','registration_amount')->where('payment_status','SUCCESS')->get();
    
     
    
        foreach($king as $queen)
        {
            $startDate = Carbon::parse($queen->updated_at);
            $endDate = Carbon::today(); 
          
            $diffInDays = $startDate->diffInDays($endDate);

            $daysLeft = 365 - $diffInDays;
      
            
            
            // echo $diffInDays."  ".$queen->user_id."  ".$daysLeft." ". $user->name." ".$user->email."<br>"; 
            
            if($daysLeft <= 10)
            {
                
                $user = User::with('paymentDataHandling')->find($queen->user_id);

                dd($user);

                $users[]=$user;
            }
        }
        if(count($users)>0)
    {
        foreach ($users as $user) {
            $user->notify(new MembershipEndingReminder());
        }

    }

    }
}

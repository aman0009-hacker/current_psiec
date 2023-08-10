<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Carbon\Carbon;

use App\Models\PaymentDataHandling;
use App\Models\User;

class DemoCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
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

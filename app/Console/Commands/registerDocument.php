<?php

namespace App\Console\Commands;

use App\Models\PaymentDataHandling;
use Carbon\Carbon;
use Faker\Provider\zh_CN\Payment;
use Illuminate\Console\Command;
use Tests\Models\User;

class registerDocument extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'register:document';

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
        
        // $main=  \DB::table('users')->where('approved','1')
        // ->leftJoin('payment_data_handling', 'users.id', '=', 'payment_data_handling.user_id')
        // ->whereNull('payment_data_handling.user_id') 
        // ->select('users.*')
        // ->get();

       
        
        // foreach($main as $singleMain)
        // {
        //     $details = [
        //         'email' => 'PSIEC ADMIN PANEL',
        //         'body' => 'Congratulations!!! Your documents are verified,please do the payment',
        //     ];
        //     \Mail::to($singleMain->email)->send(new \App\Mail\PSIECMail($details));  
    
    
        // }

        $main = User::where('approved', '1')
        ->leftJoin('payment_data_handling', 'users.id', '=', 'payment_data_handling.user_id')
        ->whereNull('payment_data_handling.user_id')
        ->select('users.*')
        ->get();

   
    
            foreach($main as $single)
            {
                
                if($single->approved_at!==null || $single->approved_at!=='')
                {
                        $date=Carbon::now()->subDay();
                        if($single->approved_at===$date)
                        {
                            $details = [
                                'email' => 'PSIEC ADMIN PANEL',
                                'body' => 'Congratulations!!! Your documents are verified,please do the payment',
                            ];
                        
                            \Mail::to($single->email)->send(new \App\Mail\PSIECMail($details));  
                        }
                         
                    }
                }
    }
}

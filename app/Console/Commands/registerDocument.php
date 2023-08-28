<?php

namespace App\Console\Commands;

use App\Models\PaymentDataHandling;
use Carbon\Carbon;
use Faker\Provider\zh_CN\Payment;
use Illuminate\Console\Command;
use App\Models\User;

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
        
    $main = User::where('approved', '1')
        ->leftJoin('payment_data_handling', 'users.id', '=', 'payment_data_handling.user_id')
      ->whereNull('payment_data_handling.user_id')
      ->select('users.*')
      ->get();
  
      
  
          foreach($main as $single)
          {
              
                  
                 
                      $approval=Carbon::parse($single->approved_at);
                      $today=Carbon::now();
                      $diffDay=$approval->diffInDays($today);
  
  
                      if($diffDay>=1 && $diffDay<=7)
                      {
                          $details = [
                                      'email' => 'PSIEC ADMIN PANEL',
                                      'body' => 'Your Registration payment is still pending,Please pay the payable amount of Rs 100000 to registered',
                                  ];
                              
                                  \Mail::to($single->email)->send(new \App\Mail\PSIECMail($details));
                      }
  
  
                  }







       
    }
}

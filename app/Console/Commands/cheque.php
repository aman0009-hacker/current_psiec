<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class cheque extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cheque:enter';

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
        $orderData=User::leftJoin('orders','users.id','=','orders.user_id')
          ->where('orders.payment_mode','cheque')
          ->where('orders.Cheque_Date',null)
          ->get();
          
      
          foreach($orderData as $singleOrder)
          {
              
             $created=Carbon::parse($singleOrder->created_at);
              $date=Carbon::now();
               $difference=$created->diffInDays($date);
               

               if($difference>=1 && $difference<=20)
               {
               
                $details=[
                    "email"=>"PSIEC ADMIN PANEL",
                    "body"=>"Your OrderNo : $singleOrder->order_no cheque payment is still pending,Please pay the payable amount or you will get 13% interst everyday."
                ]  ;
                \Mail::to($singleOrder->email)->send(new \App\Mail\PSIECMail($details));    
               }
               elseif($difference>=21 && $difference>=21)
               {
                $details=[
                    "email"=>"PSIEC ADMIN PANEL",
                    "body"=>"Your OrderNo : $singleOrder->order_no cheque payment is still pending,Please pay the payable amount or you will get 13% interst everyday."
                ]  ;
                \Mail::to($singleOrder->email)->send(new \App\Mail\PSIECMail($details)); 
               }



                 
                
              }
    }
}

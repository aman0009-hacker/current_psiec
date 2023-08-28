<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\PaymentDataHandling;
use App\Models\User;


class sendingEmail extends Controller
{
    public function king()
    {
       
        // $king = PaymentDataHandling::where('data','registration_amount')->where('payment_status','SUCCESS')->get();
    
       
    
        // foreach($king as $queen)
        // {
             
        //     $startDate = Carbon::parse($queen->updated_at);
            
        //     $endDate = Carbon::now(); 
            
        //     $diffInDays = $startDate->diffInDays($endDate);
            
        //     $daysLeft = 365 - $diffInDays;
            
         
            
        //     if($daysLeft <= 10)
        //     {
        //        if($daysLeft === 0)
        //        {
        //         continue;
        //        }
        //        else
        //        {
               
        //         $user = User::find($queen->user_id);
        //         $mail=$user->email;
             
        //        $details = [
        //         'email' => 'PSIEC ADMIN PANEL',
        //         'body' => 'Your subscription is about to expire in 10 days. Please renew your subscription to continue enjoying our services.',
              
        //     ];
        //     \Mail::to($mail)->send(new \App\Mail\PSIECMail($details));
        //        }
             
        //     }
        // }

        // $main=  \DB::table('users')->where('approved','1')
        // ->leftJoin('payment_data_handling', 'users.id', '=', 'payment_data_handling.user_id')
        // ->whereNull('payment_data_handling.user_id') 
        // ->select('users.*')
        // ->get();
        $main = User::where('approved', '1')
    ->leftJoin('payment_data_handling', 'users.id', '=', 'payment_data_handling.user_id')
    ->whereNull('payment_data_handling.user_id')
    ->select('users.*')
    ->get();

    

        foreach($main as $single)
        {
            
                
                   $date=Carbon::now()->subDay()->toDateString();
                    $approval=Carbon::parse($single->approved_at);
                    $today=Carbon::now();

                    $diffDay=$approval->diffInDays($today);

                   
                   
                $approvalDate=explode(" ",$single->approved_at);
            

                    if ($approvalDate[0] === $date) 
                    {
                       
                        $details = [
                            'email' => 'PSIEC ADMIN PANEL',
                            'body' => 'Your Registration payment is still pending,Please pay the payable amount of Rs 100000 to registered',
                        ];
                    
                        \Mail::to($single->email)->send(new \App\Mail\PSIECMail($details));
                    
                    }

                    elseif($diffDay>=2 && $diffDay<=10)
                    {
                        $details = [
                            'email' => 'PSIEC ADMIN PANEL',
                            'body' => 'Your Registration payment is still pending,Please pay the payable amount of Rs 100000 to registered',
                        ];
                    
                        \Mail::to($single->email)->send(new \App\Mail\PSIECMail($details));
                       
                    }

                   
                     
                }
            }
    

        //   $orderData=User::leftJoin('orders','users.id','=','orders.user_id')
        //   ->where('orders.payment_mode','cheque')
        //   ->where('orders.Cheque_Date',null)
        //   ->get();
        // dd($orderData[0]->order_no);
        //   foreach($orderData as $singleOrder)
        //   {
              
        //       if($singleOrder->Cheque_Date===null || $singleOrder->Cheque_Date==="")
        //       {
        //           $date=Carbon::now()->subDay();
        //           if($singleOrder->created_at===$date)
        //           {
        //                 $details=[
        //                     "email"=>"PSIEC ADMIN PANEL",
        //                     "message"=>"Your OrderNo : $singleOrder->order_no cheque payment is still pending,Please pay the payable amount or you will get 13% interst everyday or if you will not pay the amount more than 20 days you will get 20% interst everyday ."
        //                 ]  ;
        //           }
                
        //       }


        //   }
          
  

    }


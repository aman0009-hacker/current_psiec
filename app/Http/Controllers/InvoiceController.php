<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Models\PaymentDataHandling;

use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class InvoiceController extends Controller
{

    public function index(Request $request)
    {
        try {
            $orderId = Crypt::decrypt($request->input('orderIDInvoice'));
            if (isset($orderId) && !empty($orderId)) {
                //dd(Crypt::decrypt($orderIDInvoice));
                $PaymentMode = Order::find($orderId)->payment_mode;
                if ($PaymentMode == "online") {
                    $orderId = Crypt::decrypt($request->input('orderIDInvoice'));
                    $userId = Auth::user()->id;
                    //Code for invoice start
                    $order = Order::with([
                       'invoices',
                        'address',
                        'orderItems',
                        'payments'
                    ])->where('user_id',$userId)
                    ->where('id', $orderId)
                    ->first();
                    
                    // dd("ksadn");
                    if (
                        !isset($order->invoices) || $order->invoices()->count() === 0 ||
                        !isset($order->address) || $order->address()->count() === 0 ||
                        !isset($order->orderItems) || $order->orderItems()->count() === 0 ||
                        !isset($order->payments) || $order->payments()->count() === 0
                    ) {
                     

                        Alert::warning('Address is not fill yet,Please before make the payment fill the address');
                        // return redirect()->route('order')->with('error', 'Order not found.');
                    }
                   // $totalAmount = $order->payments
                    //     ->where('data', 'Booking_Final_Amount')
                    //     ->where('payment_status', 'SUCCESS')
                    //     ->value('transaction_amount') ?: ($order->payment_mode === 'cheque' ? $order->check_amount : 0);
                    $totalAmount = $order->amount;
                    $bookingAmount = $order->payments->where('data', 'Booking_Amount')->whereIn('payment_status', ['SUCCESS', 'RIP', 'SIP'])->value('transaction_amount');
                    // ii- Find tax amount
                    $cgstPercent = env('CGST', 9); // Set your CGST percentage here (e.g., 9%)
                    $sgstPercent = env('SGST', 9);
                    ; // Set your SGST percentage here (e.g., 9%)
                    $totalTaxAmount = ($totalAmount * ($cgstPercent + $sgstPercent) / 100) ?? 0;
                    $centralTaxAmount = ($totalAmount * $cgstPercent / 100) ?? 0;
                    $stateTaxAmount = ($totalAmount * $sgstPercent / 100) ?? 0;
                    // iii- Find the complete amount
                    $completeAmount = ($totalAmount + $totalTaxAmount) ?? 0;
                    $balance = $completeAmount - $bookingAmount;
                    $pdf = PDF::loadView('components.invoice', [
                        'IRN' => env('IRN', ''),
                        'AckNo' => $order->invoices->pluck('invoice_id')[0],
                        'AckDate' => Carbon::parse($order->invoices->pluck('created_at')[0])->format('Y-m-d'),
                        'PSIECAddress' => json_decode($order->address->psiec_address_ludhiana, true),
                        'shipping_name' => $order->address->shipping_name,
                        'shipping_address' => $order->address->shipping_address,
                        'shipping_state' => $order->address->shipping_state,
                        'shipping_district' => $order->address->shipping_district,
                        'shipping_city' => $order->address->shipping_city,
                        'shipping_zipcode' => $order->address->shipping_zipcode,
                        'shipping_gst_number' => $order->address->shipping_gst_number,
                        'shipping_gst_statecode' => $order->address->shipping_gst_statecode,
                        'billing_name' => $order->address->billing_name,
                        'billing_address' => $order->address->billing_address,
                        'billing_state' => $order->address->billing_state,
                        'billing_district' => $order->address->billing_district,
                        'billing_city' => $order->address->billing_city,
                        'billing_zipcode' => $order->address->billing_zipcode,
                        'billing_gst_number' => $order->address->billing_gst_number,
                        'billing_gst_statecode' => $order->address->billing_gst_statecode,
                        'InvoiceNo' => $order->invoices->pluck('invoice_id')[0],
                        'DatedInvoice' => Carbon::parse($order->invoices->pluck('created_at')[0])->format('Y-m-d'),
                        'DeliveryNote' => env('DELIVERY_NOTE', ''),
                        'ModeTermsofPayment' => $order->payment_mode,
                        'OtherReferences' => env('OTHER_REFERENCES', ''),
                        //'ReferenceNoDate' => $order->invoices->invoice_id . " " . $order->invoices->created_at,
                        'Buyers_Order_No' => $order->order_no,
                        'DatedOrderNo' => Carbon::parse($order->created_at)->format('Y-m-d'),
                        'DispatchDocNo' => env('DISPATCH_DOC_NO', ''),
                        'DeliveryNoteDate' => env('DELIVERYNOTEDATE', ''),
                        'DispatchedThrough' => env('DISPATCHED_THROUGH', ''),
                        'Destination' => env('DESTINATION', ''),
                        'BillofLandingLR-RRNo' => env('BILL_OF_LANDING_LR_RR_NO', ''),
                        'MotorVehicleNo' => env('MOTOR_VEHICLE_NO', ''),
                        'TermsofDelivery' => $order->invoices->pluck('delivery_terms')[0],
                        'DescriptionofGoods' => $order->orderItems->map(function ($orderItem) {
                            return [
                                'id' => $orderItem->id,
                                'category_name' => $orderItem->category_name,
                                'quantity' => $orderItem->quantity,
                                'price' => $orderItem->measurement,
                            ];
                        }),
                        'id' => $order->id,
                        'HSNSAC' => env('HSN_SAC', ''),
                        'Rate' => env('RATE', ''),
                        'Per' => env('PER', ''),
                        'Balance' => $balance,
                        'Amount' => $totalAmount,
                        'CGST' => $centralTaxAmount,
                        'SGST' => $stateTaxAmount,
                        'TCSonSales' => env('TCS_ON_SALES', ''),
                        'Taxablevalue' => $completeAmount,
                        'TotalTaxAmount' => $totalTaxAmount,
                        'delivery_terms' => $order->invoices->pluck('delivery_terms')[0],
                        'invoice_date' => $order->invoices->pluck('invoice_date')[0],
                        'created_at' => Carbon::parse($order->invoices->pluck('created_at')[0])->format('Y-m-d'),
                        'updated_at' => Carbon::parse($order->invoices->pluck('updated_at')[0])->format('Y-m-d'),
                        'invoice_id' => $order->invoices->pluck('invoice_id')[0],
                        'complete_amount' => $completeAmount,
                        'CGSTTAX' => $cgstPercent,
                        'SGSTTAX' => $sgstPercent,
                        'order_items' => $order->orderItems->map(function ($orderItem) {
                            return [
                                'id' => $orderItem->id,
                                'category_name' => $orderItem->category_name,
                                'quantity' => $orderItem->quantity,
                                'measurement' => $orderItem->measurement,
                            ];
                        }),
                    ]);
                    return $pdf->download('invoice.pdf');

                } else if ($PaymentMode == "cheque") {
                    //code for cheque start
                    $orderId = Crypt::decrypt($request->input('orderIDInvoice'));
                    $userId = Auth::user()->id;
                    //Code for invoice start
                    $order = Order::with([
                        'invoices',
                        'address',
                        'orderItems',
                        'payments'
                    ])->where('id', $orderId)
                        ->where('user_id', $userId)
                        ->first();
                    if (
                        !isset($order->invoices) || $order->invoices()->count() === 0 ||
                        !isset($order->address) || $order->address()->count() === 0 ||
                        !isset($order->orderItems) || $order->orderItems()->count() === 0 ||
                        !isset($order->payments) || $order->payments()->count() === 0
                    ) {
                        return redirect()->route('order')->with('error', 'Order not found.');
                    }
                    $totalAmount = $order->check_amount;
                    //new code to handle check amount start

                    if (isset($totalAmount)) {
                        $chequeAmount = $this->check_amount;
                        $chequePaymentDate = Carbon::parse($this->Cheque_Date);
                        $interestWithinAllowedPeriod = 0;
                        $allowedDays = 20;
                        $interestRateWithin20Days = 13; // 13% interest
                        $maxAllowedDays = 60;
                        $additionalInterestRateBeyond20Days = 15; // 15% interest
                        // Calculate the due date to the controller (20 days from payment date)
                        $dueDate = $chequePaymentDate->copy()->addDays($allowedDays);
                        // Calculate the number of days within the allowed period
                        $daysWithinAllowedPeriod = min($dueDate->diffInDays(Carbon::now()), $allowedDays);
                        if ($daysWithinAllowedPeriod === 0) {
                            // Calculate interest amount within the allowed period (0% interest)
                            $interestWithinAllowedPeriod = 0;
                        } else {
                            // Calculate interest amount within the allowed period
                            $interestWithinAllowedPeriod = ($daysWithinAllowedPeriod * $interestRateWithin20Days * 0.01);
                        }
                        // Calculate the number of days beyond the allowed period
                        $daysBeyondAllowedPeriod = max($dueDate->diffInDays(Carbon::now()) - $allowedDays, 0);
                        // Calculate interest amount beyond the allowed period, up to a maximum of 60 days
                        $interestBeyondAllowedPeriod = ($daysBeyondAllowedPeriod <= $maxAllowedDays)
                            ? ($daysBeyondAllowedPeriod * $additionalInterestRateBeyond20Days * 0.01)
                            : ($maxAllowedDays * $additionalInterestRateBeyond20Days * 0.01);
                        // Total interest amount
                        $totalInterestAmount = $interestWithinAllowedPeriod + $interestBeyondAllowedPeriod;
                        $totalAmount = $chequeAmount + $totalInterestAmount;
                        // Check if the max allowed days (60 days) are over
                        if ($daysBeyondAllowedPeriod > $maxAllowedDays) {
                            // Return a specific message or value for the case when max allowed days are over
                            return 0;
                        }
                        return $totalAmount;
                    } else {
                        $totalAmount = 0;
                    }
                    //new code to handle check amount end
                    // $totalAmount = $order->payments
                    //     ->where('data', 'Booking_Final_Amount')
                    //     ->where('payment_status', 'SUCCESS')
                    //     ->value('transaction_amount') ?: ($order->payment_mode === 'cheque' ? $order->check_amount : 0);
                    $bookingAmount = $order->payments->where('data', 'Booking_Amount')->whereIn('payment_status', ['SUCCESS', 'RIP', 'SIP'])->value('transaction_amount');
                    // ii- Find tax amount
                    $cgstPercent = env('CGST', 9); // Set your CGST percentage here (e.g., 9%)
                    $sgstPercent = env('SGST', 9);
                    ; // Set your SGST percentage here (e.g., 9%)
                    $totalTaxAmount = ($totalAmount * ($cgstPercent + $sgstPercent) / 100) ?? 0;
                    $centralTaxAmount = ($totalAmount * $cgstPercent / 100) ?? 0;
                    $stateTaxAmount = ($totalAmount * $sgstPercent / 100) ?? 0;
                    // iii- Find the complete amount
                    $completeAmount = ($totalAmount + $totalTaxAmount) ?? 0;
                    $balance = $completeAmount - $bookingAmount;
                    //code for cheque end
                    $pdf = PDF::loadView('components.invoice', [
                        'IRN' => env('IRN', ''),
                        'AckNo' => $order->invoices->pluck('invoice_id')[0],
                        'AckDate' => Carbon::parse($order->invoices->pluck('created_at')[0])->format('Y-m-d'),
                        'PSIECAddress' => json_decode($order->address->psiec_address_ludhiana, true),
                        'shipping_name' => $order->address->shipping_name,
                        'shipping_address' => $order->address->shipping_address,
                        'shipping_state' => $order->address->shipping_state,
                        'shipping_district' => $order->address->shipping_district,
                        'shipping_city' => $order->address->shipping_city,
                        'shipping_zipcode' => $order->address->shipping_zipcode,
                        'shipping_gst_number' => $order->address->shipping_gst_number,
                        'shipping_gst_statecode' => $order->address->shipping_gst_statecode,
                        'billing_name' => $order->address->billing_name,
                        'billing_address' => $order->address->billing_address,
                        'billing_state' => $order->address->billing_state,
                        'billing_district' => $order->address->billing_district,
                        'billing_city' => $order->address->billing_city,
                        'billing_zipcode' => $order->address->billing_zipcode,
                        'billing_gst_number' => $order->address->billing_gst_number,
                        'billing_gst_statecode' => $order->address->billing_gst_statecode,
                        'InvoiceNo' => $order->invoices->pluck('invoice_id')[0],
                        'DatedInvoice' => Carbon::parse($order->invoices->pluck('created_at')[0])->format('Y-m-d'),
                        'DeliveryNote' => env('DELIVERY_NOTE', ''),
                        'ModeTermsofPayment' => $order->payment_mode,
                        'OtherReferences' => env('OTHER_REFERENCES', ''),
                        //'ReferenceNoDate' => $order->invoices->invoice_id . " " . $order->invoices->created_at,
                        'Buyers_Order_No' => $order->id,
                        'DatedOrderNo' => Carbon::parse($order->created_at)->format('Y-m-d'),
                        'DispatchDocNo' => env('DISPATCH_DOC_NO', ''),
                        'DeliveryNoteDate' => env('DELIVERYNOTEDATE', ''),
                        'DispatchedThrough' => env('DISPATCHED_THROUGH', ''),
                        'Destination' => env('DESTINATION', ''),
                        'BillofLandingLR-RRNo' => env('BILL_OF_LANDING_LR_RR_NO', ''),
                        'MotorVehicleNo' => env('MOTOR_VEHICLE_NO', ''),
                        'TermsofDelivery' => $order->invoices->pluck('delivery_terms')[0],
                        'DescriptionofGoods' => $order->orderItems->map(function ($orderItem) {
                            return [
                                'id' => $orderItem->id,
                                'category_name' => $orderItem->category_name,
                                'quantity' => $orderItem->quantity,
                                'price' => $orderItem->measurement,
                            ];
                        }),
                        'id' => $order->id,
                        'HSNSAC' => env('HSN_SAC', ''),
                        'Rate' => env('RATE', ''),
                        'Per' => env('PER', ''),
                        'Balance' => $balance,
                        'Amount' => $totalAmount,
                        'CGST' => $centralTaxAmount,
                        'SGST' => $stateTaxAmount,
                        'TCSonSales' => env('TCS_ON_SALES', ''),
                        'Taxablevalue' => $completeAmount,
                        'TotalTaxAmount' => $totalTaxAmount,
                        'delivery_terms' => $order->invoices->pluck('delivery_terms')[0],
                        'invoice_date' => $order->invoices->pluck('invoice_date')[0],
                        'created_at' => Carbon::parse($order->invoices->pluck('created_at')[0])->format('Y-m-d'),
                        'updated_at' => Carbon::parse($order->invoices->pluck('updated_at')[0])->format('Y-m-d'),
                        'invoice_id' => $order->invoices->pluck('invoice_id')[0],
                        'complete_amount' => $completeAmount,
                        'CGSTTAX' => $cgstPercent,
                        'SGSTTAX' => $sgstPercent,
                        'order_items' => $order->orderItems->map(function ($orderItem) {
                            return [
                                'id' => $orderItem->id,
                                'category_name' => $orderItem->category_name,
                                'quantity' => $orderItem->quantity,
                                'measurement' => $orderItem->measurement,
                            ];
                        }),
                    ]);
                    return $pdf->download('invoice.pdf');
                }
            }
        } catch (\Throwable $ex) {
            Log::info($ex->getMessage());
        }
    }

}
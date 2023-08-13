<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Records;
use App\Models\Entity;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Models\UserPayment;
use Encore\Admin\Layout\Content;
use Encore\Admin\Facades\Admin;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Invoice;


class ProductCategoryController extends Controller
{
    public function index(Request $request)
    {
        try {
            //$categoryList = Category::pluck('name', 'id');
            $categoryList = Category::whereHas('product', function ($query) {
                $query->where('name', 'Steel');
            })->pluck('name', 'id');
            $categoryListCoal = Category::whereHas('product', function ($query) {
                $query->where('name', 'Coal');
            })->pluck('name', 'id');
            if ($categoryList->isNotEmpty() && $categoryListCoal->isNotEmpty()) {
                return view('components.category', compact('categoryList', 'categoryListCoal'));
            } else {
                return view('components.category')->withInput();
            }
        } catch (\Exception $ex) {
            Log::info($ex->getMessage());
            return view('components.category');
        }
    }

    public function entity(Request $request, $categoryId)
    {
        try {
            $categoryValue = $categoryId;

            if (isset($categoryValue) && !empty($categoryValue)) {
                $entityList = Entity::where("entity_id", $categoryValue)->distinct('name')->pluck('name');
                if ($entityList->isNotEmpty()) {
                    return response()->json($entityList);
                } else {
                    // return view('components.category')->withInput();
                }
            }

        } catch (\Exception $ex) {
            //return view('components.category')->withInput();
            Log::info($ex->getMessage());
        }

    }

    public function entityData(Request $request)
    {
        try {
            $categoryId = $request->input('category_data');
            if (isset($categoryId) && !empty($categoryId)) {
                $entityName = $request->input('subcategory_data');
                if (isset($entityName) && $entityName == "Select") {
                    $entities = Entity::where('entity_id', $categoryId)
                        ->get();
                    return response()->json($entities);
                } else if (isset($entityName) && !empty($entityName)) {
                    $entities = Entity::where('entity_id', $categoryId)
                        ->where('name', $entityName)
                        ->get();

                    return response()->json($entities);
                }
            } else {

            }
        } catch (\Exception $ex) {
            //return view('components.category')->withInput();
            Log::info($ex->getMessage());
        }
    }

    public function storeOrder(Request $request)
    {
        try {
            $order = new Order();
            $order->status = "New";
            $order->user_id = Auth::user()->id;
           
            $order->save();
            $users__id=Auth::user()->id;
           
            //new code to generate invoice start
            if ($order->save() === true) {
                $lastInvoice = Invoice::orderByDesc('invoice_id')->first();
                
                $newInvoiceId = $lastInvoice ? $lastInvoice->invoice_id + 1 : 1;
                $invoice = new Invoice();
                //$invoice->id = \Ramsey\Uuid\Uuid::uuid4(); // Generate a new UUID for the 'id' column
                $invoice->delivery_terms = 'This information has been provided as a resource to familiarize PSIEC rules';
                $invoice->invoice_date = now();
                $invoice->order_id = Order::where('user_id',$users__id)->latest()->first()->id; // Replace $order with the actual Order model instance
            
                $invoice->invoice_id = $newInvoiceId;
                $invoice->created_at = now();
                $invoice->updated_at = now();
                $invoice->save();
            }
            //new code to generte invoice end
            if ($order->save()) {
                $latestId = Order::latest()->first()->id;
                if (isset($latestId) && !empty($latestId)) {
                    $orderItem = new OrderItem();
                    $orderItem->order_id = $latestId;
                    $orderItem->category_name = $request->input('name');
                    $orderItem->description = $request->input('description');
                    $orderItem->diameter = $request->input('diameter');
                    $orderItem->size = $request->input('size');
                    $orderItem->quantity = $request->input('quantity');
                    $orderItem->measurement = $request->input('measurement');
                    $orderItem->save();
                    return response()->json(["response" => "successful"]);
                }

            }
        } catch (\Exception $ex) {
            Log::info($ex->getMessage());
        }
        // return response()->json(["msg"=>$name]);
    }


    public function booking(Request $request)
    {
        try {
            if (Auth::check()) {
                $orders = Order::where('user_id', Auth::user()->id)->whereIn('status', ['New', 'Approved'])->orderBy('created_at', 'desc')->get();
                foreach ($orders as $order) {
                    $order->orderItems = OrderItem::where('order_id', $order->id)->get();
                }
                return view('components.booking', compact('orders'));
            }
        } catch (\Exception $ex) {
            Log::info($ex->getMessage());
        }
    }

    public function order(Request $request)
    {
        try {
            if (Auth::check()) {
                //$orders = Order::where('user_id', Auth::user()->id)->where('status', 'Dispatched')->orderBy('created_at', 'desc')->get();
                $orders = Order::where('user_id', Auth::user()->id)
                    ->where(function ($query) {
                        $query->whereIn('status', ['Dispatched', 'Payment_Done', 'Rejected']);
                    })
                    ->orderBy('created_at', 'desc')
                    ->get();
                foreach ($orders as $order) {
                    $order->orderItems = OrderItem::where('order_id', $order->id)->get();
                }
                return view('components.order', compact('orders'));
            }
        } catch (\Exception $ex) {
            Log::info($ex->getMessage());
        }
    }

    public function records(Request $request)
    {
        try {
            //return response()->json(["msg" => "success"]);
            $product = $request->input('product');
            $quantity = $request->input('quantity');
            $description = $request->input('description');
            if (isset($product) && !empty($product) && isset($quantity) && !empty($quantity)) {
                $query = new Records;
                $query->product = $product;
                $query->quantity = $quantity;
                $query->description = $description;
                $query->save();
                if ($query->save()) {
                    return response()->json(["status" => "success", "statusCode" => 200]);
                }
            }
        } catch (\Exception $ex) {
            Log::info($ex->getMessage());
        }
    }

    public function storeSupervisor(Request $request)
    {
        try {
            $count = $request->hidden;
            $data = new Records;
            //dd($count);
            for ($a = 0; $a < $count; $a++) {

                $data->product = $request->input('product');
                $data->quantity = $request->input('quantity');
                $data->description = $request->input('notes');
            }
            $data->save();
            //dd($data->save);
            return redirect('/admin/records');
        } catch (\Exception $ex) {
            Log::info($ex->getMessage());
        }
    }


    //verifyAdminStatusOrder
    public function verifyAdminStatusOrder(Request $request)
    {
        try {
            if (Auth::check()) {
                $adminStatus = $request->input('adminStatus');
                if (isset($adminStatus) && !empty($adminStatus)) {
                    $id = Auth::user()->id;
                    if (isset($id)) {
                        $status = Order::where('user_id', $id)->where('status', $adminStatus)->get();
                        return response()->json(["msg" => "success", "statusCode" => "200", "orderStatus" => $status]);
                    }
                }
            }
        } catch (\Exception $ex) {
            Log::info($ex->getMessage());
        }
        //return response()->json(["msg"=>"success"]);
    }

    public function verifyAdminStatus(Request $request)
    {
        try {
            if (Auth::check()) {
                $adminStatus = $request->input('adminStatus');

                if (isset($adminStatus) && !empty($adminStatus)) {
                    $id = Auth::user()->id;
                    if (isset($id)) {
                        //$status = Order::where('user_id', $id)->where('status', $adminStatus)->value('status');
                        $status = Order::where('user_id', $id)->where('status', $adminStatus)->get();
                        return response()->json(["msg" => "success", "statusCode" => "200", "orderStatus" => $status]);
                    }
                }
            }
        } catch (\Exception $ex) {
            Log::info($ex->getMessage());
        }
        //return response()->json(["msg"=>"success"]);
    }

    public function storing(Request $request)
    {
        try {
            $adminID = Admin::user()->id;
            if (isset($adminID) && !empty($adminID)) {
                $this->validate($request, [
                    'product' => 'required',
                    'quantity' => 'required',
                    'amount' => 'required'
                ]);
                $hide = $request->hide;
                $date = $request->date;
                $product = $request->product;
                $quantity = $request->quantity;
                $amount = $request->amount;
                for ($a = 0; $a < $hide; $a++) {
                    $data = new Records();
                    $data->date = $date[$a];
                    $data->product = $product[$a];
                    $data->quantity = $quantity[$a];
                    $data->amount = $amount[$a];
                    $data->description = $request->description;
                    $data->supervisor_id = $adminID;
                    $data->save();
                }
                return redirect('/admin/records');
            }
        } catch (\Exception $ex) {
            Log::info($ex->getMessage());
        }
    }


    public function storeOrderBulk(Request $request)
    {
        try {
            if (Auth::check()) {
                $rowsValues = $request->input('rowsValues');

                $items = count($rowsValues);
                if (isset($rowsValues) && count($rowsValues) > 0) {
                    $order = new Order();
                    $order->status = "New";
                    $order->user_id = Auth::user()->id;
                    $order->save();
                    $users__id=Auth::user()->id;
                    //new code to generate invoice start
                    if ($order->save() === true) {
                        $lastInvoice = Invoice::orderByDesc('invoice_id')->first();
                        $newInvoiceId = $lastInvoice ? $lastInvoice->invoice_id + 1 : 1;
                        $invoice = new Invoice();
                        //$invoice->id = \Ramsey\Uuid\Uuid::uuid4(); // Generate a new UUID for the 'id' column
                        $invoice->delivery_terms = 'This information has been provided as a resource to familiarize PSIEC rules';
                        $invoice->invoice_date = now();
                        $invoice->order_id = Order::where('user_id',$users__id)->latest()->first()->id;; // Replace $order with the actual Order model instance
                        $invoice->invoice_id = $newInvoiceId;
                        $invoice->created_at = now();
                        $invoice->updated_at = now();
                        $invoice->save();
                    }
                    //new code to generte invoice end

                    
                    if ($order->save()) {
                        $latestId = Order::latest()->first()->id;
                        foreach ($rowsValues as $data) {
                            $orderItem = new OrderItem();
                            $orderItem->order_id = $latestId;
                            $orderItem->category_name = $data['name'];
                            $orderItem->description = $data['description'];
                            $orderItem->diameter = $data['diameter'];
                            $orderItem->size = $data['size'];
                            $orderItem->quantity = $data['quantity'];
                            $orderItem->measurement = $data['measurement'];
                            $orderItem->save();

                        }
                    }
                }
            }
        } catch (\Exception $ex) {
            Log::info($ex->getMessage());
        }
    }


    public function payment_info_store(Request $request)
    {
        try {
            $dropDownPayment = $request->input('dropDownPayment');
            $name = $request->input('name');
            $date_value = $request->input('date_value');
            $cvv = $request->input('cvv');
            $transaction_no = rand(1000, 100000);
            $order_id = rand(10, 1000);
            $transaction_date = Carbon::now();
            if (isset($dropDownPayment) && isset($name) && isset($date_value) && isset($cvv) && isset($transaction_no) && isset($order_id) && isset($transaction_date)) {
                $UserPayment = new UserPayment();
                $UserPayment->source = $dropDownPayment;
                $UserPayment->transaction_date = $transaction_date;
                $UserPayment->transaction_id = $transaction_no;
                $UserPayment->user_id = Auth::user()->id;
                $UserPayment->orderno = $order_id;
                $UserPayment->payment_status = "Success";
                // $UserPayment->save();
                if ($UserPayment->save()) {
                    return redirect()->route('congratulations');
                }
            }
        } catch (\Exception $ex) {
            Log::info($ex->getMessage());
        }
    }

    public function supervisor(Content $content)
    {
        try {
            $data = Entity::all();
            return $content->body(view('supervisor', compact('data')));
        } catch (\Exception $ex) {
            Log::info($ex->getMessage());
        }
    }

    public function refreshCaptcha()
    {
        return response()->json(['captcha' => captcha_img()]);
    }
}
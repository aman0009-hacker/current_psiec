<?php

use App\Http\Controllers\deletingdata;
use App\Http\Controllers\maindata;
use App\Http\Controllers\newupdatedcontroller;
use App\Http\Controllers\registerUserController;
use App\Http\Controllers\sendingEmail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OTPHandleController;
use App\Http\Controllers\DocumentProcessController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ProductCategoryController;
use App\Models\UserPayment;
use App\Models\PaymentDataHandling;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OrderProcessController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\InvoiceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return view('home');
})->name('home');

Route::post('/registering',[registerUserController::class,'index'])->name('registerUser');


Route::get('/home', function () {
    return view('home');
})->name('/home');
Route::get('signup', function () {
    return view('auth.signUp');
})->name('signUp');
Route::get('login', function () {
    return view('auth.login');
})->name('login');
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get("/forgot-password", function () {
    return view('auth.forgot-password');
})->name('forgot-password');
Route::get("/dummy", function () {
    return view("components.invoice");
});
Route::get('refresh_captcha', [ProductCategoryController::class, 'refreshCaptcha'])->name('refresh_captcha');
Route::get("/resetPassword", function () {
    return view('auth.resetPassword');
});
Route::post("/records", [ProductCategoryController::class, 'records'])->name('records');
Route::get("admin/records/create", [ProductCategoryController::class, 'supervisor']);
Route::post("/chartApproveStatus", [App\Admin\Controllers\CustomPageController::class, 'chartApproveStatus'])->name('chartApproveStatus');
Route::post("/checkStatus", [LoginController::class, 'chartStatus'])->name('checkStatus');
Route::get('/chat', function () {
    return view('components.chat'); })->name('chat');
Route::post('chatData', [App\Admin\Controllers\CustomPageController::class, 'chatData'])->name('chatData');
Route::post('chatDataPost', [App\Admin\Controllers\CustomPageController::class, 'chatDataPost'])->name('chatDataPost');
Route::post('checkurl', [App\Admin\Controllers\CustomPageController::class, 'checkurl'])->name('checkurl');
Route::post('checkurlIndex', [App\Admin\Controllers\CustomPageController::class, 'checkurlIndex'])->name('checkurlIndex');

//Route::middleware(['auth'])->group(function () {
    Route::get('/payment', function () {
        return view('components.payment');
    });
    Route::get('/totalPayment', function () {
        return view('components.total-payment');
    });
    Route::get('userDocument', function () {
        return view('components.user-document');
    })->name('userDocument');
    Route::get('updatedDocument', function () {
        return view('components.updated-documents');
    })->name('updatedDocument');
    // Route::get('documentProcess', function () {
    //     return view('components.document-process');
    // })->name('documentProcess');
    Route::get('documentProcess',[newupdatedcontroller::class,'main'])->name('documentProcess');
    Route::get('signUpSubmit', function () {
        return view('auth.signUpSubmit');
    })->name('signUpSubmit');
    Route::get('/logout', function () {
        Auth::logout();
        Session::flush();
        return redirect('/login');
    })->name('logout');
    Route::get("/redirect", function (Request $request) {
        if (Auth::check()) {
            if (Auth::user()->state == 1) {
                return redirect()->route('signUpSubmit');
            } else if (Auth::user()->state == 2) {

                return redirect()->route('userDocument');
            } else if (Auth::user()->state == 3) {
                return redirect()->route('documentProcess');
            } else {
                // $userId = Auth::id();
                // $userStatus = User::find($userId)->approved;
                // if (isset($userStatus) && $userStatus === 1) {
                //     $userPayment = PaymentDataHandling::whereIn('payment_status', ['RIP', 'SIP', 'SUCCESS'])
                //         ->where('data', 'Registration_Amount')
                //         ->where('user_id', $userId)
                //         ->first();
                //     if ($userPayment && isset($userPayment)) {
                //         return redirect()->route('RawMaterial');
                //     } else {
                //         return redirect()->route('payment.process');
                //     }
                // } else if (isset($userStatus) && $userStatus === 2) {
                //     return redirect()->route('chat');
                // } else if (isset($userStatus) && $userStatus === 0) {
                //     return redirect()->route('/home');
                // }
                return redirect()->route('/home');
            }
        }
        return redirect()->route('/home');
    });
    Route::get('document-process-update', function () {
        return view('components.document-process-update');
    })->name('documentUpdate');
    //Route::get("dashboard", function () { return view('dashboard'); })->name('dashboard');

    Route::get('PaymentDetails', function () {
        return view('components.payment-details');
    })->name('PaymentDetailsView');
    Route::any('congratulations', function () {
        return view('components.congratulations');
    })->name('congratulations');
    Route::get('/supervisor_records', function () {
        return view('supervisor_records');
    });
    Route::post('ajaxRequest', [OTPHandleController::class, 'ajaxRequestPost'])->name('ajaxRequest.post');
    Route::post('store', [OTPHandleController::class, 'store'])->name('store');
    Route::post('ajaxRequestPostDocument', [DocumentProcessController::class, 'ajaxRequestPostDocument'])->name('ajaxRequest.postdocument');
    Route::post('fileUploadPost', 'App\Http\Controllers\FileUploadController@fileUploadPost')->name('file.upload.post');
    Route::post('post-login', [LoginController::class, 'postLogin'])->name('login.post');
    Route::post('documentOutput', [DocumentProcessController::class, 'documentOutput'])->name('documentOutput');
    Route::post('myaccount', [LoginController::class, 'myaccount'])->name('myaccount');
    Route::post('fileUploadPostUpdate', 'App\Http\Controllers\FileUploadController@fileUploadPostUpdate')->name('file.upload.post.update');
    Route::post('userMsgHandling', [FileUploadController::class, 'userMsgHandling'])->name('userMsgHandling');
    Route::post('adminMsgHandling', [App\Admin\Controllers\CustomPageController::class, 'adminMsgHandling'])->name('adminMsgHandling');
    Route::post('adminReturnMsg', [FileUploadController::class, 'adminReturnMsg'])->name('adminReturnMsg');
    Route::post('dropzone/store', [FileUploadController::class, 'store'])->name('dropzone.store');
    Route::post('adminDownload', [App\Admin\Controllers\CustomPageController::class, 'adminDownload'])->name('adminDownload');
    Route::get("PaymentDetails/{id}", [App\Admin\Controllers\CustomPageController::class, 'PaymentDetails'])->name('PaymentDetails');
    Route::get("PaymentDetailsOrder/{id}/{status}", [App\Admin\Controllers\CustomPageController::class, 'PaymentDetailsOrder'])->name('PaymentDetailsOrder');
    Route::post('/entities/{categoryId}', [ProductCategoryController::class, 'entity'])->name('category.entities');
    Route::get('/RawMaterial', [ProductCategoryController::class, 'index'])->name('RawMaterial');
    Route::post('/entityData', [ProductCategoryController::class, 'entityData'])->name('entityData');
    Route::post('/storeOrder', [ProductCategoryController::class, 'storeOrder'])->name('storeOrder');
    Route::get("/booking", [ProductCategoryController::class, 'booking'])->name('booking');
    Route::get("/order", [ProductCategoryController::class, 'order'])->name('order');
    Route::post('storeSupervisor', [ProductCategoryController::class, 'storeSupervisor'])->name('storeSupervisor');
    Route::post('verifyAdminStatus', [ProductCategoryController::class, 'verifyAdminStatus'])->name('verifyAdminStatus');
    Route::post('verifyAdminStatusOrder', [ProductCategoryController::class, 'verifyAdminStatusOrder'])->name('verifyAdminStatusOrder');
    Route::post('/storing', [ProductCategoryController::class, 'storing'])->name('storing');
    Route::post('/storeOrderBulk', [ProductCategoryController::class, 'storeOrderBulk'])->name('storeOrderBulk');
    Route::post('/payment_info_store', [ProductCategoryController::class, 'payment_info_store'])->name('payment_info_store');
    Route::post("/payment/process/data", [PaymentController::class, 'paymentProcess'])->name('payment.process.data');
    Route::get("/payment/process", [PaymentController::class, 'index'])->name('payment.process');
    Route::get("/payment/verify", [PaymentController::class, 'paymentVerify'])->name('payment.verify');
    Route::get("/payment/process/verify", [PaymentController::class, 'paymentProcessVerify'])->name('payment.process.verify');
    Route::get("/payment/user-id", [PaymentController::class, 'getUserId'])->name('payment.get-user-id');
    Route::post("/payment/process/data/order", [PaymentController::class, 'paymentProcessOrder'])->name('payment.process.data.order');
    Route::any("/orderProcess", [OrderProcessController::class, 'index'])->name('orderProcess');
    Route::post('/payment/process/verify/extra/js', [OrderProcessController::class, 'jspart']);
    Route::post("/payment/process/data/order/complete", [PaymentController::class, 'paymentProcessOrderComplete'])->name('payment.process.data.order.complete');
    Route::any("/payment/complete/process", [PaymentController::class, 'paymentComplete'])->name('payment.complete.process');
    Route::get("/payment/complete/process/{id}/{status}", [PaymentController::class, 'paymentCompletion'])->name('payment.complete.process');
    Route::get('profile', [profileController::class, 'profile'])->name('userprofile');
    Route::post('userdata', [profileController::class, 'storedata'])->name('userimage');
    Route::post('remove', [profileController::class, 'removeimage'])->name('removeimage');
    Route::post('address', [profileController::class, 'addresssave'])->name('profile-address');
    Route::post("/payment/complete/process/address", [PaymentController::class, 'paymentCompleteProcessAddress'])->name('payment.complete.process.address');
    Route::prefix('user')->group(function () {
        Route::get('dashboard', [profileController::class, 'userdashboard'])->name('userdashboard');
        Route::get('order', [profileController::class, 'userorder'])->name('userorder');
        Route::get('address', [profileController::class, 'useraddress'])->name('useraddress');
        
    });
// });

Route::get('invoice', [InvoiceController::class, 'index'])->name('invoice');
/*Charts Route*/
Route::get("/totalOrdersCount", [App\Admin\Controllers\CustomPageController::class, 'getTotalOrdersCount'])->name('total.orders.count');
Route::get("/totalOrdersAmount", [App\Admin\Controllers\CustomPageController::class, 'getTotalOrdersAmount'])->name('total.orders.amount');
Route::get("/totalUsers", [App\Admin\Controllers\CustomPageController::class, 'getTotalUsersCount'])->name('total.user');
Route::get("/totalYards", [App\Admin\Controllers\CustomPageController::class, 'getTotalYardCount'])->name('total.yards');
/*Charts Route*/
Route::get('imagestore/{maindata}',[FileUploadController::class, 'storeimagecomment']);
Route::get('get-cities/{stateId}', [PaymentController::class, 'getCities']);

Route::get('wallet', [profileController::class, 'wallet'])->name('wallet');



Route::get('sendthemail',[sendingEmail::class,'king']);
Route::get('emailagain','App\Http\Controllers\approved_for_document@data');





Route::get('checkbox',[maindata::class,'main']);
// Route::post('/delete-rows',deletingdata::class,'delete');
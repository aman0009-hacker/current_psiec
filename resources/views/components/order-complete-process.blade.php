<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Process</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/congratulations.css') }}" />
    {{--
    <link rel="stylesheet" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css"> --}}
    <!-- STYLE CSS -->
    {{--
    <link rel="stylesheet" href="{{asset('css_payment/style.css')}}"> --}}
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/login-signup/admin_logo_img.png') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script> --}}
    <script src="{{ asset('js/finalpayment.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
    {{-- <script src="{{ asset('js/prevent-back-sweetalert.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
</head>
<style>
    .modal-dialog {
        max-width: 700px;
        margin-right: auto;
        margin-left: auto;
    }

    .bill_display {
        display: none;
    }

    @import url("https://rsms.me/inter/inter.css");

    :root {
        --color-gray: #737888;
        --color-lighter-gray: #e3e5ed;
        --color-light-gray: #f7f7fa;
    }

    *,
    *:before,
    *:after {
        box-sizing: inherit;
    }

    html {
        font-family: "Inter", sans-serif;
        font-size: 14px;
        box-sizing: border-box;
    }

    /* @supports (font-variation-settings-normal) {
        html {
            font-family: "Inter var", sans-serif;
        }
    } */

    body {
        margin: 0;
    }

    h1 {
        margin-bottom: 1rem;
    }

    p {
        color: var(--color-gray);
    }

    hr {
        height: 1px;
        width: 100%;
        background-color: var(--color-light-gray);
        border: 0;
        margin: 2rem 0;
    }

    .container {
        max-width: 40rem;
        padding: 3vw 2rem 3vw 0;
        margin: 0 auto;
    }

    .form {
        display: grid;
        grid-gap: 1rem;
    }

    .field {
        width: 100%;
        display: flex;
        flex-direction: column;
        border: 1px solid var(--color-lighter-gray);
        padding: .5rem;
        border-radius: .25rem;
    }

    .field__label {
        color: var(--color-black);
        font-size: 1rem;
        font-weight: 300;
        text-transform: uppercase;
        margin-bottom: 0.25rem
    }

    .field__input {
        padding: 0;
        margin: 0;
        border: 0;
        outline: 0;
        font-weight: bold;
        font-size: 1.5rem;
        width: 100%;
        -webkit-appearance: none;
        appearance: none;
        background-color: transparent;
    }

    .field:focus-within {
        border-color: #000;
    }

    .fields {
        display: grid;
        grid-gap: 1rem;
    }

    .fields--2 {
        grid-template-columns: 1fr 1fr;
    }

    .fields--3 {
        grid-template-columns: 1fr 1fr 1fr;
    }

    .button {
        background-color: #000;
        text-transform: uppercase;
        font-size: 0.8rem;
        font-weight: 600;
        display: block;
        color: #fff;
        width: 100%;
        padding: 1rem;
        border-radius: 0.25rem;
        border: 0;
        cursor: pointer;
        outline: 0;
    }

    .button:focus-visible {
        background-color: #333;
    }

    .error {
        color: red;
    }
</style>

<body>
    @include('vendor.sweetalert.alert')
    <div class="main">
        <div class="container-fluid p-4">
            <div class="sign-up-page">
                <div class="row">
                    <div class="col-12 col-md-7">
                        <div class="background-image d-flex align-items-center">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="user-welocme">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <span class="welcome-text">WELCOME TO
                                                            <span class="welcome-border"></span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 industries-export-text">
                                                        <span>Punjab Small Industries & Export Corporation</span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <span class="state-text">(A State Government Undertaking)</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row d-none d-md-block">
                                        <div class="col-12">
                                            <div class="sign-up-footer">
                                                <div class="row align-items-baseline">
                                                    <div class="col-4">
                                                        <div class="policy-warranty-link">
                                                            <a href="#">Privacy Policy</a>
                                                            <span class="text-white"> | </span>
                                                            <a href="#">PSIEC Product Warranty</a>
                                                        </div>
                                                    </div>
                                                    <div class="col-8 copy-right-section">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <p class="copy-right-text">© Copyright 2023 PSIEC. All
                                                                    rights reserved.</p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-12 owners-text">
                                                                <p>All trademarks used herein are property of their
                                                                    respective owners.</p>
                                                                <p>Any use of third party trademarks is for
                                                                    identification purposes only and does not imply
                                                                    endorsement.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-5 user-signUp">
                        <div class="user-signUp-form process-pending-form d-block">
                            {{-- @php
                            echo $txtOrderGlobalModalCompleteID;
                            @endphp --}}
                            <?php
                                $encryptedResponse = request('encryptedResponse');
                                if(isset($encryptedResponse) && !empty($encryptedResponse)) {
                                $decryptedResponse = Illuminate\Support\Facades\Crypt::decrypt($encryptedResponse);
                                $paymentResponse = $decryptedResponse['paymentResponse'] ?? '';
                                $reference_no = $decryptedResponse['reference_no'] ?? '';
                                $transaction_id = $decryptedResponse['transaction_id'] ?? '';
                                // $txtOrderGlobalModalCompleteID=$txtOrderGlobalModalCompleteID ?? '';
                                $txtOrderGlobalModalCompleteID=Session::get('txtOrderGlobalModalCompleteID') ?? '';
                             if( $paymentResponse!="" && $paymentResponse!=null && $paymentResponse=="SUCCESS")
                               {
                               ?>
                            <?php
                            }
                            else if($paymentResponse!="" && $paymentResponse!=null && $paymentResponse=="FAILURE")
                               {
                                ?>
                            <div class="alert alert-warning" role="alert">
                                <p>Payment has not verified. Kindly try again or contact system administrator for
                                    further process.</p>
                            </div>
                            <?php
                               }
                            }
                           ?>
                            <form method="post" action="{{ route('payment.process.data.order.complete') }}">
                                {{-- {{dd($txtOrderGlobalModalCompleteID)}} --}}
                                @csrf
                                <div class="row text-center">
                                    <div class="col-12">
                                        <img src="{{ asset('images/login-signup/doc-success.png') }}"
                                            alt="process-pending" class="img-fluid process-pending" width="220"
                                            height="220">
                                            <h1 class="sign-up-text document-text">Payment Process</h1>
                                            <div class="action" id="invoiceDownload" style="display: none" >
                                                <a class="btn continue-btn w-45 mb-3 " href="{{ route('invoice') }}?orderIDInvoice={{Crypt::encrypt($txtOrderGlobalModalCompleteID ?? '')}}" class="link-success" id="download-invoice-link">Show Invoice</a>
                                            </div>
                                        <div class="col-12">
                                            {{-- error handling --}}
                                            @error('paymentMode')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                            @error('amountOrderFinal')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                            {{-- error handling --}}
                                            <div class="input-group mb-3 mt-2">
                                                <label class="input-group-text" for="paymentMode">Payment Mode</label>
                                                <select class="form-select" id="paymentMode" name="paymentMode"
                                                    required>
                                                    <option value="" selected>Select Payment Mode</option>
                                                    <option value="online">online</option>
                                                    <option value="cheque">cheque</option>
                                                </select>
                                            </div>
                                            <div class="input-group mt-2" id="divPayment">
                                                <span class="input-group-text">₹</span>
                                                <input type="number" class="form-control" placeholder="Enter amount"
                                                    aria-label="Amount" name="amountOrderFinal" id="amountOrderFinal"value="{{$amount[0] ?? ''}}">
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="action">
                                            <button type="submit" class="btn continue-btn w-100">Continue</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="row d-block d-md-none">
                            <div class="col-12">
                                <div class="sign-up-footer">
                                    <div class="row align-items-baseline">
                                        <div class="col-4">
                                            <div class="policy-warranty-link">
                                                <a href="#">Privacy Policy</a>
                                                <span class="text-white"> | </span>
                                                <a href="#">PSIEC Product Warranty</a>
                                            </div>
                                        </div>
                                        <div class="col-8 copy-right-section">
                                            <div class="row">
                                                <div class="col-12">
                                                    <p class="copy-right-text">© Copyright 2023 PSIEC. All rights
                                                        reserved.</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 owners-text">
                                                    <p>All trademarks used herein are property of their respective
                                                        owners.</p>
                                                    <p>Any use of third party trademarks is for identification purposes
                                                        only and does not imply endorsement.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal fff-->
    <div class="modal fade" id="Payment" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="form">
                    @csrf
                    <div class="container">
                        <input type="hidden" name="txtOrderGlobalModalCompleteIDValue"
                            id="txtOrderGlobalModalCompleteIDValue"
                            value="{{ Session::get('txtOrderGlobalModalCompleteID') ?? ''}}">
                        <h1>Shipping</h1>
                        <p>Please enter your shipping details.</p>
                        @if (count($errors))
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li class="mt-2">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <hr />
                        <div class="form">
                            <label class="field mt-4">
                                <span class="field__label" for="firstname">Shipping name</span>
                                <input class="field__input" name="shipping_name" type="text" id="shipping_name"
                                    value="{{ $address->shipping_name ?? '' }}" />
                            </label>
                            <label class="field">
                                <span class="field__label" for="state">Shipping Address</span>
                                <input class="field__input" type="text" name="shipping_address"
                                    value="{{ $address->shipping_address ?? '' }}" id="shipping_address" />
                            </label>
                            <div class="fields fields--2 ">
                                <label class="field">
                                    <span class="field__label" for="lastname">GST IN/UIN<span style="color:red">★</span>
                                        (15 digits)</span>
                                    <input class="field__input" name="shipping_gst_number"
                                        value="{{ $address->shipping_gst_number ?? '' }}" type="text"
                                        id="shipping_gst_number" value="" />
                                </label>
                                <label class="field">
                                    <span class="field__label" for="address">GST state code </span>
                                    <input class="field__input" name="shipping_gst_statecode"
                                        value="{{ $address->shipping_gst_statecode ?? '' }}" type="number"
                                        id="shipping_gst_statecode" />
                                </label>
                            </div>
                            <div class="fields fields--2">
                                <label class="field">
                                    <span class="field__label" for="country">State</span>
                                    {{-- <input class="field__input" type="text" value="{{ $address->shipping_state ?? '' }}"
                                        name="shipping_state" id="shipping_state" /> --}}
                                    <select class="field__input" name="shipping_state" id="shipping_state">
                                        <option value="">Select State</option>
                                        @foreach ($states as $state)
                                        <option value="{{$state->id}}"  {{(isset($address->shipping_state) && $state->name == $address->shipping_state) ? 'selected' : '' }}>{{$state->name}}</option>
                                        @endforeach
                                    </select>
                                </label>
                                <label class="field">
                                    <span class="field__label" for="country">District</span>
                                    <input class="field__input" type="text" name="shipping_district"
                                        id="shipping_district" value="{{ $address->shipping_district ?? '' }}" />
                                </label>
                            </div>
                            <div class="fields fields--2">
                                <label class="field">
                                    <span class="field__label" for="city">City</span>
                                    {{-- <input class="field__input" name="shipping_city" type="text" id="shipping_city"
                                        value="{{ $address->shipping_city ?? '' }}" /> --}}
                                        @if(isset($address->shipping_city))
                                            <select class="field__input" name="shipping_city" id="shipping_city">
                                                <option value="{{$address->shipping_city}}">{{$address->shipping_city}}</option>
                                            </select>
                                        @else
                                            <select class="field__input" name="shipping_city" id="shipping_city">
                                                <option value="">Select City</option>
                                            </select>
                                        @endif
                                </label>
                                <label class="field">
                                    <span class="field__label" for="zipcode">Zip code</span>
                                    <input class="field__input" name="shipping_zipcode" type="text"
                                        id="shipping_zipcode" value="{{ $address->shipping_zipcode ?? '' }}" />
                                </label>
                            </div>
                            <div style="display:flex">
                                <input class="form-check-input me-2 " name="is_same" type="checkbox" id="checkbill"
                                    style="flex:0 0 3%" />
                                <label class="form-check-label float-left" for="form7Example8" style="flex:0 0 100%">
                                    Is Billing Address Same with Shipping Address</label>

                            </div>
                        </div>
                        <div id="bill_address">
                            <hr>
                            <h1>Billing</h1>
                            <p>Please enter your billing details.</p>
                            <hr />
                            <div class="form">
                                <label class="field ">
                                    <span class="field__label" for="firstname">Billing name</span>
                                    <input class="field__input" name="billing_name" type="text" id="billing_name"
                                        value="{{ $address->billing_name ?? '' }}" />
                                </label>
                                <label class="field">
                                    <span class="field__label" for="state">Billing Address</span>
                                    <input class="field__input" type="text" name="billing_address" id="billing_address"
                                        value="{{ $address->billing_address ?? '' }}" />
                                </label>
                                <div class="fields fields--2 ">
                                    <label class="field">
                                        <span class="field__label" for="lastname">GST IN/UIN<span
                                                style="color:red">★</span> (15 digits)</span>
                                        <input class="field__input" name="billing_gst_number" type="text"
                                            id="billing_gst_number" value="{{ $address->billing_gst_number ?? '' }}" />
                                    </label>
                                    <label class="field">
                                        <span class="field__label" for="address">GST state code</span>
                                        <input class="field__input" type="number" name="billing_gst_statecode"
                                            type="text" id="billing_gst_statecode"
                                            value="{{ $address->billing_gst_statecode ?? '' }}" />
                                    </label>
                                </div>
                                <div class="fields fields--2">
                                    <label class="field">
                                        <span class="field__label" for="country">State</span>
                                        {{-- <input class="field__input" type="text" name="billing_state" id="billing_state"
                                            value="{{ $address->billing_state ?? '' }}" /> --}}
                                        <select class="field__input" name="billing_state" id="billing_state">
                                            <option value="">Select State</option>
                                            @foreach ($states as $state)
                                            <option value="{{$state->id}}"  {{(isset($address->billing_state) && $state->name == $address->billing_state) ? 'selected' : '' }}>{{$state->name}}</option>
                                            @endforeach
                                        </select>
                                    </label>
                                    <label class="field">
                                        <span class="field__label" for="country">District</span>
                                        <input class="field__input" type="text" name="billing_district"
                                            id="billing_district" value="{{ $address->billing_district ?? '' }}" />
                                    </label>
                                </div>
                                <div class="fields fields--2">
                                    <label class="field">
                                        <span class="field__label" for="city">City</span>
                                        {{-- <input class="field__input" name="billing_city" type="text" id="billing_city"
                                            value="{{ $address->billing_city ?? '' }}" /> --}}
                                        @if(isset($address->billing_city))
                                            <select class="field__input" name="billing_city" id="billing_city">
                                                <option value="{{$address->billing_city}}">{{$address->billing_city}}</option>
                                            </select>
                                        @else
                                            <select class="field__input" name="billing_city" id="billing_city">
                                                <option value="">Select City</option>
                                            </select>
                                        @endif
                                    </label>
                                    <label class="field">
                                        <span class="field__label" for="zipcode">Zip code</span>
                                        <input class="field__input" name="billing_zipcode" type="number"
                                            id="billing_zipcode" value="{{ $address->billing_zipcode ?? '' }}" />
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="button mt-3" type="submit" style="background:#00465F ">Save Address</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#checkbill').on('change', function() {
                if (this.checked) {
                    $('#bill_address').addClass('bill_display');
                } else {
                    $('#bill_address').removeClass('bill_display');
                }
            });
            $("#form").validate({
                rules: {
                    'amountOrderFinal': {
                        required: true,
                    },
                    'shipping_name': {
                        required: true,
                    },
                    'shipping_address': {
                        required: true,
                    },
                    'shipping_state': {
                        required: true,
                    },
                    'shipping_district': {
                        required: true,
                    },
                    'shipping_city': {
                        required: true,
                    },
                    'shipping_zipcode': {
                        required: true,
                        minlength: 6,
                        maxlength: 6,
                    },
                    'shipping_gst_number': {
                        required: true,
                        minlength: 15,
                        maxlength: 15,
                    },
                    'shipping_gst_statecode': {
                        required: true,
                        minlength: 2,
                        maxlength: 2,
                    },
                    'billing_name': {
                        required: true,
                    },
                    'billing_address': {
                        required: true,
                    },
                    'billing_state': {
                        required: true,
                    },
                    'billing_district': {
                        required: true,
                    },
                    'billing_city': {
                        required: true,
                    },
                    'billing_zipcode': {
                        required: true,
                        minlength: 6,
                        maxlength: 6,
                    },
                    'billing_gst_number': {
                        required: true,
                        minlength: 15,
                        maxlength: 15,
                    },
                    'billing_gst_statecode': {
                        required: true,
                        minlength: 2,
                        maxlength: 2,
                    }
                },
                messages: {
                    'amountOrderFinal': "Please enter Order Amount.",
                    'shipping_name': "Please enter a valid Shipping Name.",
                    'shipping_address': "Please enter a valid Shipping Address.",
                    'shipping_state': "Please enter a valid Shipping State.",
                    'shipping_district': "Please enter a valid Shipping District.",
                    'shipping_city': "Please enter a valid Shipping City.",
                    'shipping_zipcode': "Please enter a valid Shipping Zipcode.",
                    'shipping_gst_number': "Please enter your GST Number (15 digit).",
                    'shipping_gst_statecode': "Please enter a valid Shipping GST Code.",
                    'billing_name': "Please enter a valid Billing Name.",
                    'billing_address': "Please enter a valid Billing Address.",
                    'billing_state': "Please enter a valid Billing State.",
                    'billing_district': "Please enter a valid Billing District.",
                    'billing_city': "Please enter a valid Billing City.",
                    'billing_zipcode': "Please enter a valid Billing Zipcode.",
                    'billing_gst_number': "Please enter your GST Number (15 digit).",
                    'billing_gst_statecode': "Please enter a valid Billing GST Code.",
                }
            });
            $('#form').submit(function(event) {
                event.preventDefault(); // Prevent the default form submission
                var formData = $(this).serialize();
                // Send AJAX request
                $.post('/payment/complete/process/address', formData)
                    .done(function(response) {
                        if(response.success==false)
                        {
                            swal.fire({
                            title: 'Address Not Saved',
                            icon: 'warning',
                        });
                        }
                        else
                        {
                            $('#Payment').modal('hide').remove();
                            console.log('done')
                            swal.fire({
                                title: 'Address Saved Successfully',
                                icon: 'success',
                            });
                        }
                    })
                    .fail(function(error) {
                        // Request failed
                        console.log('Error:', error);
                        swal.fire({
                            title: 'Order Not Found',
                            text:'Please placed order first',
                            icon: 'warning',
                        });
                    });
            });
                $('#shipping_state').on('change', function() {
                var stateId = $(this).val();
                if (stateId) {
                    $.ajax({
                        url: '/get-cities/' + stateId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#shipping_city').empty();
                            $('#shipping_city').append('<option value="">Select City</option>');
                            $.each(data, function(key, value) {
                                $('#shipping_city').append('<option value="' + value.name + '">' + value.name + '</option>');
                            });


                        }
                    });
                } else {
                    $('#shipping_city').empty();
                    $('#shipping_city').append('<option value="">Select City</option>');
                }
            });
            $('#billing_state').on('change', function() {
                var stateId = $(this).val();
                if (stateId) {
                    $.ajax({
                        url: '/get-cities/' + stateId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#billing_city').empty();
                            $('#billing_city').append('<option value="">Select City</option>');
                            $.each(data, function(key, value) {
                                $('#billing_city').append('<option value="' + value.name + '">' + value.name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#billing_city').empty();
                    $('#billing_city').append('<option value="">Select City</option>');
                }
            });
        });
    </script>
</body>

</html>

@extends('layouts.main_account')
@section('content')
{{-- custom logic --}}
<?php
    if(Auth::check())
    {
       ?>
<script>
  $("#mySignUp").hide();
           $("#myLogin").hide();
           $("#myid").show();
           $("#logoutid").show();
           $("#myOrder").show();

</script>
<?php
    }
?>
{{-- custom logic --}}
<!-- Booking Section -->
<section class="booking">
  <form id="userBookingFormData">
    @csrf
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h3>
            My Orders
          </h3>
        </div>
      </div>


      {{-- New Code to show Payment Success Page --}}
      <?php
       $encryptedResponse = request('encryptedResponse');
       if(isset($encryptedResponse) && !empty($encryptedResponse))
       {
       $decryptedResponse = Illuminate\Support\Facades\Crypt::decrypt($encryptedResponse);
       $paymentResponse = $decryptedResponse['paymentResponse'] ?? '';
       $reference_no = $decryptedResponse['reference_no'] ?? '';
       $transaction_id = $decryptedResponse['transaction_id'] ?? '';
      if( $paymentResponse!="" && $paymentResponse!=null && $paymentResponse=="SUCCESS")
      {
       ?>
      <script>
        Swal.fire({
           title: 'Payment Done Succesfully.Your Payment Reference No is <?php echo $reference_no; ?>',
           showClass: {
             popup: 'animate__animated animate__fadeInDown'
           },
           hideClass: {
             popup: 'animate__animated animate__fadeOutUp'
           }
         })
      </script>
      <?php
      }
     }
             else if(request('paymentMode')!=null && !empty(request('paymentMode')) && request('paymentMode')=="cheque")
           {
            ?>
      <script>
        Swal.fire({
      title: 'Payment Mode set cheque successfully',
      showClass: {
      popup: 'animate__animated animate__fadeInDown'
    },
    hideClass: {
      popup: 'animate__animated animate__fadeOutUp'
    }
  })
      </script>
      <?php
           }
      ?>
      {{-- New Code to show Payment Success Page --}}
    @include('vendor.sweetalert.alert');
      <div class="row orderhistoryOne-section">
        <div class="col-md-12">
          @foreach ($orders as $index => $order)
          <div class="row historyBox mb-3">
            <div class="col-12 col-sm-12 col-md-3 col-lg-3">
              <h4 class="orderid mb-0"><span>Order ID:</span>{{ $order->order_no ?? '' }}</h4>
            </div>
            <div class="col-12 col-sm-12 col-md-3 col-lg-3">
              <!-- Display additional order information if needed -->
              <h4 class="orderid mb-0"><span>Final Payment:</span>
                @if ($order->final_payment_status === 'verified')
                Done ( {{$order->payment_mode}} )
                @elseif($order->final_payment_status === 'unverified' && $order->payment_mode === 'cheque')
                Cheque(Pending)
                @else
                Pending
                @endif
              </h4>
            </div>



            @if ($order->status=="Dispatched" || $order->status=="Payment_Done")
            <div class="col-12 col-sm-12 col-md-3 col-lg-3">
              <!-- Display additional order information if needed -->
              <h4 class="orderid mb-0"><span></span>
               <a href="{{ route('invoice') }}?orderIDInvoice={{Crypt::encrypt($order->id)}}" class="link-success" id="download-invoice-link">Download Invoice</a>
              </h4>
            </div>
            @endif



            {{-- new code start  --}}
            {{-- @if ($order->status=="Dispatched" || $order->status=="Payment_Done")
            <div class="col-12 col-sm-12 col-md-3 col-lg-3">
                <!-- Display additional order information if needed -->
                <h4 class="orderid mb-0"><span></span>
                    <a href="javascript:void(0)" class="link-success" id="download-invoice-link" onclick="openModal({{ $order->id }})">Download Invoice</a>
                </h4>
            </div>

            <!-- Modal HTML structure -->
            <div class="modal" id="quantityModal" style="display: none;">
                <div class="modal-content">
                    <h3>Enter Quantity</h3>
                    <input type="number" id="quantityInput" placeholder="Quantity" min="1" />
                    <button onclick="handleOk()">OK</button>
                    <button onclick="hideModal()">Cancel</button>
                </div>
            </div>

            <script>
                let orderId; // Global variable to store the orderId

                // Function to show the modal and store the orderId
                function openModal(orderId) {
                    orderId = orderId;
                    document.getElementById('quantityModal').style.display = 'block';
                }

                // Function to hide the modal
                function hideModal() {
                    document.getElementById('quantityModal').style.display = 'none';
                }

                // Function to handle the OK button click
                function handleOk() {
                    // Get the input value
                    const quantity = parseInt(document.getElementById('quantityInput').value);

                    // Perform validation (e.g., check if the quantity is valid)
                    if (isNaN(quantity) || quantity < 1) {
                        alert('Please enter a valid quantity.');
                        return;
                    }

                    // Form the URL with orderId only
                    const encryptedOrderId = Crypt.encrypt(orderId);
                    const url = `{{ route('invoice') }}?orderIDInvoice=${encryptedOrderId}`;
                    window.location.href = url;

                    // Hide the modal after successful action
                    hideModal();
                }
            </script>
        @endif --}}


            {{-- new code end  --}}













            <div class="col-12 col-sm-12 col-md-3 col-lg-3">
              <h4 class="orderplaced mb-0">
                <span>Booking Date: </span><span class="order-status">{{ $order->created_at ?? '' }}</span>
              </h4>
            </div>
          </div>
          @if ($order->status === 'Rejected')
          <div class="alert alert-danger" role="alert">
            Order Rejected
          </div>
          @elseif ($order->status === 'Delivered')
          <div class="alert alert-success" role="alert">
            Order Delivered
          </div>
          @endif
          <div class="row">
            <div class="col-md-12">
              <div class="table-responsive">
                <table class="table" style="width:100%">
                  <thead class="bg-gray">
                    <tr>
                      <th style="width:25%">CATEGORY NAME</th>
                      <th style="width:25%">DESCRIPTION</th>
                      {{-- <th style="width:15%">Diameter</th>
                      <th style="width:15%">Size</th> --}}
                      <th style="width:25%">Quantity</th>
                      <th style="width:25%">MEASUREMENT</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($order->orderItems as $orderItem)
                    <tr>
                      <td>
                        <a href="" class="text-underline">{{ $orderItem->category_name ?? '' }}</a>
                      </td>
                      <td>{{ $orderItem->description ?? '' }}</td>
                      {{-- <td>{{ $orderItem->diameter ?? '' }}</td>
                      <td>{{ $orderItem->size ?? '' }}</td> --}}
                      <td>{{ $orderItem->quantity ?? '' }}</td>
                      <td>{{ $orderItem->measurement ?? '' }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-12 text-center">
              {{-- <a href="" class="btn btn-secondary order-btn" id="bookingUserStatus">View Order Details</a> --}}
              <button type="button" class="btn btn-secondary order-btn bookingUserStatusOrder"
                id="bookingUserStatus{{ $order->id }}" data-status="{{ $order->status }}"
                data-order-ids="{{ $order->id }}">View Order Details</button>
              {{-- <button type="button" class="btn btn-secondary order-btn bookingUserStatus">View Order
                Details</button> --}}
            </div>
          </div>
          @if (!$loop->last)
          <hr style="border-top: 3px solid black; margin-top: 15px;">
          @endif
          @endforeach
        </div>
      </div>
    </div>
  </form>
</section>
@endsection
<!-- Confirmation Modal -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="order-box mt-5">
              <p>
                Your Booking Confirmation
                <span>on waiting</span>
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer mb-4">
        {{-- <a href="" class="btn btn-secondary continue-btn" data-bs-target="#makepaymentnModal"
          data-bs-toggle="modal">ok</a> --}}
        <a href="" class="btn btn-secondary continue-btn" data-bs-toggle="modal">ok</a>
        <!-- <button type="button" class="btn btn-primary continue-btn">Ok</button> -->
      </div>
    </div>
  </div>
</div>
<!-- Make payment Modal -->
<!-- Confirmation Modal -->
<div class="modal fade" id="makepaymentnModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="order-box mt-5">
              <p>Your Booking Approved.</p>
              <p>Kindly Pay Booking amount as
                <span>per PSIEC Policy.</span>
              </p>
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer mb-4">
        <a href="/orderProcess" class="btn btn-secondary continue-btn">Make Payment</a>
        <!-- <button type="button" class="btn btn-primary continue-btn">Ok</button> -->
      </div>
    </div>
  </div>
</div>
{{-- Other Confirmation Model --}}
<div class="modal fade" id="makepaymentnModals" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="order-box mt-5">
              <p>Your order is ready for delivery.</p>
              <p>Kindly make a full payment
                <span>against invoice.</span>
              </p>
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer mb-4">
        <form action="/payment/complete/process" method="post">
          @csrf
          <input type="hidden" name="txtOrderGlobalModalCompleteID" id="txtOrderGlobalModalCompleteID">
          {{-- <a href="/orderProcess" class="btn btn-secondary continue-btn">Make Payment</a> --}}
          <button type="submit" class="btn btn-secondary continue-btn">Make Payment</button>
          <!-- <button type="button" class="btn btn-primary continue-btn">Ok</button> -->
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="alreadyPaidTotalAmount" tabindex="-1" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">PSIEC Panel</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="order-box mt-5">
              <p>Amount has successfully received by PSIEC.</p>
              <p>Orders has delivered soon.</span>
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer mb-4">
        {{-- <a href="/order" class="btn btn-secondary continue-btn">Make Payment</a> --}}
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="makepaymentnModalRejection" tabindex="-1" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="order-box mt-5">
              <p>Your Booking has Rejected.</p>
              {{-- <p>Kindly Pay Booking amount as
                <span>per PSIEC Policy.</span>
              </p> --}}
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer mb-4">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
        <!-- <button type="button" class="btn btn-primary continue-btn">Ok</button> -->
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="makepaymentnModalRejectionAdmin" tabindex="-1" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="order-box mt-5">
              <p>Kindly contact the administrator for live update.</p>
              {{-- <p>Kindly Pay Booking amount as
                <span>per PSIEC Policy.</span>
              </p> --}}
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer mb-4">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
        <!-- <button type="button" class="btn btn-primary continue-btn">Ok</button> -->
      </div>
    </div>
  </div>
</div>

@extends('shared.main')
@section('content')
<style>
   .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 20px;
   }
   .logo img {
      max-width: 140px;
      height: auto;
   }
   .details {
      text-align: right;
   }
   h1 {
      font-size: 24px;
      margin: 0;
   }
   p {
      margin: 5px 0;
   }
   .horizontal-line {
      border-bottom: 1px solid #000;
   }
</style>

<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0">Confirm Payment</h1>
         </div>
         <div class="col-sm-6 text-right">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="#">Payments</a></li>
               <li class="breadcrumb-item active">Confirm Payment</li>
            </ol>
         </div>
      </div>
   </div>
</div>

<section class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <div class="callout callout-warning bg-secondary header">
               <div class="logo">
                  <img src="{{ asset('assets/img/logo.png') }}" alt="Posb Logo">
                  <h1 style="color: orange;">CROSS BORDER PAYMENT</h1>
               </div>
               <div class="details">
                  <h1>POSB HEAD OFFICE</h1>
                  <p>6th Floor, Causeway Building Cnr 3rd Street and, Central Ave</p>
                  <p>Harare Zimbabwe</p>
                  <p>+263 242 252595/6</p>
                  <h1 style="color: orange;">PROOF OF PAYMENT</h1>
               </div>
            </div>

            <div class="invoice p-3 mb-3">
               <div class="row">
                  <div class="col-12">
                     <h2>
                        {{-- <small class="float-right">Reference: {{ $paymentReference }} </small><br>
                        <small class="float-right">Date: {{ $payment->created_at }}</small> --}}
                     </h2>
                  </div>
               </div>
               <hr>

               <div class="row invoice-info">
                  <div class="col-sm-3 invoice-col">
                     Teller/Agent
                     <hr>
                     <address>
                        <strong>Full Name :</strong> {{ request()->user()->first_name ." ".request()->user()->last_name }}<br>
                        <strong>Email :</strong> {{request()->user()->email}}<br>
                     </address>
                  </div>

                  <div class="col-sm-3 invoice-col">
                     Sender Details
                     <hr>
                     <address>
                        <strong>First Name :</strong> {{$sender->first_name}} <br>
                        <strong>Surname :</strong> {{$sender->surname}} <br>
                        <strong>ID Number :</strong> {{ $sender->id_number}}<br>
                        <strong>Phone Number:</strong> {{ $sender->phone_number}}<br>
                        <strong>House Number :</strong> {{ $sender->house_number }} <br>
                        <strong>Area :</strong> {{ $sender->area }} <br>
                        <strong>City :</strong> {{ $sender->city }} <br>
                     </address>
                  </div>

                  <div class="col-sm-3 invoice-col">
                     Receiver Details
                     <hr>
                     <address>
                        <strong>First Name :</strong> {{$receiver->rec_first_name}} <br>
                        <strong>Surname :</strong> {{$receiver->rec_surname}} <br>
                        <strong>Phone Number:</strong> {{ $receiver->recipient_account_uri}}<br>
                        <strong>House Number :</strong> {{ $receiver->rec_house_number }} <br>
                        <strong>Area :</strong> {{ $receiver->rec_area }} <br>
                        <strong>City :</strong> {{ $receiver->rec_city }} <br>
                        <strong>Country :</strong> {{ $receiver->fxrate->country }} <br>
                        <strong>Payment Method :</strong> 
                        @if($receiver->payment_method == 'BD')
                           Bank Deposit
                        @elseif($receiver->payment_method == 'MW')
                           Mobile Wallet
                        @elseif($receiver->payment_method == 'CP')
                           Cash Pick Up
                        @elseif($receiver->payment_method == 'IB')
                           Bank Deposit
                        @else
                           {{ $receiver->payment_method }}
                        @endif
                        <br>
                        <strong>Amount :</strong> {{ number_format($amount * $receiver->fxrate->rate, 2) }} {{ $receiver->fxrate->currency }}<br>
                        @if($receiver->rec_ban)
                           <strong>BAN (Bank Account Number):</strong> {{ $receiver->rec_ban }} <br>
                        @endif
                        @if($receiver->rec_bic)
                           <strong>BIC (Bank Identifier Code):</strong> {{ $receiver->rec_bic }} <br>
                        @endif
                        @if($receiver->rec_iban)
                           <strong>IBAN:</strong> {{ $receiver->rec_iban }} <br>
                        @endif
                        @if($receiver->recipient_account_uri)
                           <strong>Phone Number:</strong> +{{ $receiver->recipient_account_uri }} <br>
                        @endif
                     </address>
                  </div>

                  <div class="col-sm-3 invoice-col">
                     Charges Details
                     <hr>
                     <address>
                        <strong>Source Of Income :</strong> {{ $source_of_income }} <br>
                        <strong>Purpose Of Payment :</strong> {{ $purpose_of_payment }} <br>
                        <strong>Principal Amount :</strong> {{ $amount }} <br>
                        <strong>Fees Charge :</strong> {{ $amount * 0.06 }} <br>
                        <strong>Total Amount:</strong> {{ $amount * 0.06 + $amount }} USD <br>
                     </address>
                  </div>
               </div>

               <div class="col-12">
                  <form method="post" action="/payment/submit_payment">
                     @csrf
                     <input type="hidden" name="total_principal_amount" value="{{$amount * 0.06}}">
                     <input type="hidden" name="principal_amount" value="{{$amount}}">
                     <input type="hidden" name="source_of_income" value="{{$source_of_income}}">
                     <input type="hidden" name="purpose_of_payment" value="{{$purpose_of_payment}}">
                     <input type="hidden" name="recever_id" value="{{$receiver->id}}">
                     <input type="hidden" name="sender_id" value="{{$sender->id}}">
                     <input type="hidden" name="amount" value="{{ number_format($amount * $receiver->fxrate->rate, 2, '.', '') }}">
                     <input type="hidden" name="currency" value="{{ $receiver->fxrate->currency}}">
                     <button type="submit" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit Payment</button>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
@endsection

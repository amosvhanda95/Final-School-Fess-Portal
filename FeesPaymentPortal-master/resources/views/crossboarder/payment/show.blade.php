@extends('shared.main')
@section('content')
<style>
   
   .header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px; /* Adjust padding as needed */
    
}
.logo img {
    max-width: 140px; /* Adjust logo width as needed */
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
    border-bottom: 1px solid #000; /* You can adjust the thickness and color */
}
</style>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Confirmed Payment</h1>
            </div>
            <div class="col-sm-6 text-right"> <!-- Use text-right class -->
                <!-- Logo goes here -->
               
           
            
                
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="#">Payments</a>
                    </li>
                    <li class="breadcrumb-item active">Confirmed Payment</li>
                </ol>
            </div>
        </div>
    </div>
</div>


    <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="callout callout-warning bg-secondary  header">
                            <div class="logo">
                            <img src="{{ asset('assets/img/logo.png') }}" clas alt="Posb Logo"   height: auto;">
                            <h1 style="color: orange;">FEES PAYMENT</h1>
                            </div>
                            <div class="details">
                                <h1>POSB HEAD OFFICE</h1>
                                <p>6th Floor, Causeway Building Cnr 3rd Street and, Central Ave</p>
                                <p>Harare Zimbabwe</p>
                                <p>+263 242 252595/6</p> <br>
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

                                </div><br><br>
                                <hr>
                            </div>

                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    Teller/ Agent <hr>
                                    <address>
                                        <strong>Full Name :</strong> {{ request()->user()->last_name }}<br>
                                        <strong>Email :</strong> {{request()->user()->email}}<br>
                                    </address>
                                </div>

                                <div class="col-sm-4 invoice-col">
                                    Sender Details <hr>
                                    <address>
                                        <strong>First Name:</strong> {{ $sendmoney->sender_first_name }}<br>
                                        <strong>Last Name:</strong> {{ $sendmoney->sender_last_name }}<br>
                                        <strong>Date of Birth:</strong> {{ $sendmoney->sender_date_of_birth }}<br>
                                        <strong>House Number:</strong> {{ $sendmoney->sender_house_number }}<br>
                                        <strong>Address Area:</strong> {{ $sendmoney->sender_address_area }}<br>
                                        <strong>City:</strong> {{ $sendmoney->sender_city }}<br>
                                        <strong>Phone Number:</strong> {{ $sendmoney->sender_phone_number }}<br>
                                        <strong>ID Number:</strong> {{ $sendmoney->sender_id }}<br>
                                    </address>
                                </div>
                                
                                <div class="col-sm-4 invoice-col">
                                    Payment Details<hr>
                                    <address>
                                        <strong>Transaction Reference:</strong> {{ $sendmoney->transaction_reference }} <br>
                                        <strong>Status:</strong> {{ $sendmoney->status }} <br>
                                        <strong>Charged Amount:</strong> {{ $sendmoney->charged_amount }} <br>
                                        <strong>Fees Amount:</strong> {{ $sendmoney->fees_amount }} <br>
                                        {{-- <strong>Credited Amount:</strong> {{ $sendmoney->credited_amount }} <br> --}}
                                        <strong>Principal Amount:</strong> {{ $sendmoney->principal_amount }} <br>
                                        <strong>Currency:</strong> {{ $sendmoney->currency }} <br>
                                        {{-- <strong>FX Rate:</strong> {{ $sendmoney->fx_rate }} <br> --}}
                                        <strong>Payment Type:</strong> {{ $sendmoney->payment_type }} <br>
                                    </address>
        
                                </div>

                                <div class="col-sm-4 invoice-col">
                                    Branch Details <hr>
                                    <b>Branch Name : </b> {{ $branch->branch_name }}Branch: <br>
                                    <b>Branch Address : </b> {{ $branch->branch_address }}<br>
                                    <b>Branch Email : </b> {{$branch->email }}<br>
                                    <b>Branch Phone Number : </b> {{ $branch->mobile_number }}<br>
                                </div>
                                <div class="col-sm-4 invoice-col">
                                    Recipient Details <hr>
                                    <address>
                                        <strong>First Name:</strong> {{ $sendmoney->recipient_first_name }}<br>
                                        <strong>Last Name:</strong> {{ $sendmoney->recipient_last_name }}<br>
                                        <strong>House Number:</strong> {{ $sendmoney->recipient_house_number }}<br>
                                        <strong>Address Area:</strong> {{ $sendmoney->recipient_address_area }}<br>
                                        <strong>City:</strong> {{ $sendmoney->recipient_city }}<br>
                                        <strong>Gender:</strong> {{ $sendmoney->recipient_gender }}<br>
                                        <strong>Currency:</strong> {{ $sendmoney->receive_currency }}<br>
                                        <strong>Amount:</strong> {{ $sendmoney->amount }}<br>
                                        <strong>Account URI:</strong> {{ $sendmoney->recipient_account_uri }}<br>
                                        <strong>Cashout Code:</strong> {{ $sendmoney->cashout_code }}<br>
                                    </address>
                                </div>
                                
                                <br>
                                

                                <div class="disclaimer-container text-center invoice-col col-sm-12 pt-10">
                                    <h3 class="mb-4">DISCLAIMER</h3>
                                    <p>Recipients of this proof of payment notification should confirm with their bank that funds have been received before releasing any goods or offering a service. This proof of payment is not a receipt. The information contained on this proof of payment is confidential and may contain proprietary information. If you are not the intended recipient, any disclosure, copying, distribution, or any action taken or omitted in reliance on this is prohibited and may be unlawful.</p>
                                
                                    <p>Enquiries regarding this payment notification should be directed to the POSB Contact Centre on +263 242 252595/6, +263 8677009200, or customersupport@posb.co.zw. Please contact the payer for enquiries regarding the contents of this notification. POSB does not accept any liability or responsibility for any interception, corruption, destruction, loss, late arrival, or incompleteness of or tampering or interference with any of the information contained in this notification or for its incorrect delivery or non-delivery for whatsoever reason or for its effect on any electronic device of the recipient.</p>
                                </div> </div>
                            <div class="row no-print">
                                <div class="col-12">
                                    <a href="javascript:void(0);" onclick="printInvoice()" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                                    {{-- <form method="post" action="{{ route('payment.submit_payment') }}">
                                        @csrf
                                        <input type="hidden" name="payment_id" value="{{$payment->id}}">
                                        <button  type="submit" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                                            Payment
                                        </button>
                                    </form> --}}
                                    {{-- <a href="/payment/{{$payment->id}}">
                                    <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                        <i class="fas fa-download"></i> Generate PDF
                                    </button>
                                    </a> --}}
                                    <a href="/crossboader-payment"> 
                                    <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                        <i class="fas fa-edit"></i> Submit Payment
                                    </button>
                                {{-- </a> --}}

                                    

                                    


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
    <script>
        function printInvoice() {
            window.print();
        }
    </script>
@endsection



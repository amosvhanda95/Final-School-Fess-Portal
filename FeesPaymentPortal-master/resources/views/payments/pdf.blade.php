<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

   
</head>
<body>
   
    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            Teller/ Agent <hr>
            <address>
                <strong>Full Name :</strong> {{ request()->user()->last_name }}<br>
                <strong>Email :</strong> {{request()->user()->email}}<br>
            </address>
        </div>

        <div class="col-sm-4 invoice-col">
            Payment Details<hr>
            <address>
                
                <strong>Reference : </strong>{{$payment->payment_status  }} <br>
                <strong>Status : </strong>{{$payment->currency  }} <br>
                <strong>School Name : </strong>{{ $payment->school->school_name }}<br>
                <strong>Bank Account Number:</strong> {{ $payment->bankAccount->account_number }}<br>
                <strong>Amount  : </strong>{{ $payment->amount }} <br>
                <strong>Currency :</strong> {{ $payment->currency_value }} <br>
                <strong>Date :</strong> {{ $payment->created_at }} <br>
                
                
            </address>
        </div>
        <div class="col-sm-4 invoice-col">
            Student Details<hr>
            <address>
                
                <strong>Student Name :</strong> {{ $payment->student_name }} <br>
                <strong>Student Reg Number  :</strong> {{ $payment->reg_number }}<br>
             
                <strong>Class  :</strong> {{ $payment->class }} <br>
                <strong>Term  : </strong>{{ $payment->term }} <br>
                <strong>Semester  : </strong>{{ $payment->semester }} <br>
                <strong>Purpose  : </strong>{{ $payment->purpose }} <br>
                
            </address>
        </div>

        <div class="col-sm-4 invoice-col">
            Branch Details <hr>
            <b>Branch Name : </b> {{ $payment->branch->branch_name }}<br>
            <b>Branch Address : </b> {{ $payment->branch->branch_address }}<br>
            <b>Branch Email : </b> {{ $payment->branch->email }}<br>
            <b>Branch Phone Number : </b> {{ $payment->branch->mobile_number }}<br>
        </div>
        <div class="col-sm-4 invoice-col">
            Deposit Details<hr>
            <address>
                                            
                <strong>Depositor Name : </strong>{{ $payment->depositor_name }}<br>
                <strong> Mobile Number: </strong>{{ $payment->customer_phone_number }}<br>
                
                
            </address>
        </div>
        <br>
        

        <div class="disclaimer-container text-center invoice-col col-sm-12 pt-10">
            <h3 class="mb-4">DISCLAIMER</h3>
            <p>Recipients of this proof of payment notification should confirm with their bank that funds have been received before releasing any goods or offering a service. This proof of payment is not a receipt. The information contained on this proof of payment is confidential and may contain proprietary information. If you are not the intended recipient, any disclosure, copying, distribution, or any action taken or omitted in reliance on this is prohibited and may be unlawful.</p>
        
            <p>Enquiries regarding this payment notification should be directed to the POSB Contact Centre on +263 242 252595/6, +263 8677009200, or customersupport@posb.co.zw. Please contact the payer for enquiries regarding the contents of this notification. POSB does not accept any liability or responsibility for any interception, corruption, destruction, loss, late arrival, or incompleteness of or tampering or interference with any of the information contained in this notification or for its incorrect delivery or non-delivery for whatsoever reason or for its effect on any electronic device of the recipient.</p>
        </div>
     </div>
</body>

</html>